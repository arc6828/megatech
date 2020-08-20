<?php
namespace App\Http\Controllers\Sales;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderModel;
use App\Sales\OrderDetail2Model;
use App\Sales\OrderDetailModel;
use App\Sales\OrderDetailStatusModel;
use App\Sales\QuotationModel;

use App\Purchase\RequisitionModel;
use App\Purchase\RequisitionDetailModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;
use App\Functions;

use App\GaurdStock;

use PDF;
use Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_order = OrderModel::select_by_keyword($q);
      $table_order = (Auth::user()->role === "admin" )?
          OrderModel::select_all() :
          OrderModel::select_all_by_user_id(Auth::id());
      $data = [
        //QUOTATION
        'table_order' => $table_order,
      ];
      return view('sales/order/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $quotation_code = $request->input('quotation_code');
      if(!empty($quotation_code)){
        $tb_quotation = QuotationModel::select_by_id($quotation_code);
        $customer_code = (count($tb_quotation)>0) ? $tb_quotation[0]->customer_code : "";
      }else{
        $customer_code = "";
      }
      $data = [
          //QUOTATION
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('order'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'customer_code' => $customer_code,
          //QUOTATION DETAIL
          'table_order_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('sales/order/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //INSERT QUOTATION : VALIDATE OVERCREDIT
      $code = $this->getNewCode();
      $datetime = date('Y-m-d H:i:s');
      if(!empty($request->input('datetime_custom'))){
        $datetime = $request->input('datetime_custom');
        
        $code = $this->getNewCodeCustom($datetime);
      }
      $input = [
          'order_code' => $code,
          'datetime' => $datetime,
          'external_reference_id' => $request->input('external_reference_id'),
          'customer_id' => $request->input('customer_id'),
          'debt_duration' => $request->input('debt_duration'),
          'billing_duration' => $request->input('billing_duration'),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time'),
          'department_id' => $request->input('department_id'),
          'sales_status_id' => $request->input('sales_status_id'),
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
          'vat' => $request->input('vat',0),
          'total_before_vat' => $request->input('total_before_vat',0),
          'total' => $request->input('total_after_vat',0),
      ];
      
      $id = OrderModel::insert($input);

      //UPLOAD FILE P/O
      if ($request->hasFile('po_file')) {
        $folder = "customer/po";
        
        $requestData['po_file'] = $request->file('po_file')->store($folder, 'public');
        //$requestData['po_file'] = "sss.jpg";
        $order = OrderModel::findOrFail($id);
        $order->update($requestData);
      }

      //INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      //print_r($request->input('product_id_edit'));
      //print_r($request->input('amount_edit'));
      //print_r($request->input('discount_price_edit'));
      //echo $id;
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          $list[] = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $request->input('amount_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "order_id" => $id,
          ];

          //UPDATE QUOTATION sales_status_id = 5 which mean complete

          QuotationModel::update_by_id(["sales_status_id"=>5] , $request->input('quotation_code_edit')[$i]);
          //UPDATE QUOTATION DETAIL sales_status_id = 5 which mean complete
          //QuotationModel::update_by_id(["sales_status_id"=>5] , $request->input('discount_price_edit')[$i]);
        }
      }
      OrderDetail2Model::insert($list);

      OrderDetailModel::insert($list);


      //GAURD STOCK      
      foreach($list as $item){
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $item['order_id'],
          "type" => "sales_order",
          "amount" => $item['amount'],
          "amount_in_stock" => $product->amount_in_stock,
          "pending_in" => $product->pending_in,
          "pending_out" => ($product->pending_out + $item['amount']),
          "product_id" => $product->product_id,
        ]);
        
        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();

      }

      
      //PR
      $this->store2($request,$code);



      return redirect("sales/order/{$id}");
    }

    public function getNewCode(){
        $number = OrderModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $order_code = "OE{$year}{$month}-{$number}";
        return $order_code;
    }

    public function getNewCodeCustom($dateString){
      $number = OrderModel::select_count_by_current_month_custom($dateString);
      $count =  $number + 1;
      //$year = (date("Y") + 543) % 100;
      $date=date_create($dateString);
      //echo date_format($date,"Y/m/d H:i:s");

      $year = date_format($date,"y");
      $month = date_format($date,"m");
      $number = sprintf('%05d', $count);
      $order_code = "OE{$year}{$month}-{$number}";
      return $order_code;
    }

    public function store2(Request $request,$code)
    {
      //INSERT QUOTATION
      $input = [
          'purchase_requisition_code' => $this->getNewCode2(),
          'external_reference_id' => $request->input('external_reference_id'),
          'internal_reference_id' => $code,
          'customer_id' => $request->input('customer_id'),
          'debt_duration' => $request->input('debt_duration'),
          'billing_duration' => $request->input('billing_duration'),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time'),
          'department_id' => $request->input('department_id'),
          'purchase_status_id' => $request->input('purchase_status_id',1),
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id'),
          'remark' => $request->input('remark'),
          'vat' => $request->input('vat'),
          'vat_percent' => $request->input('vat_percent',7),
          'total' => $request->input('total',0),
      ];
      $id = RequisitionModel::insert($input);

      //INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      //print_r($request->input('product_id_edit'));
      //print_r($request->input('amount_edit'));
      //print_r($request->input('discount_price_edit'));
      //echo $id;
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          //HAVE X
          $product = ProductModel::findOrFail($request->input('product_id_edit')[$i]);

          $hasX = strtolower(substr($product->product_code, -1)) == "x";
          //$checkOthers = true;
          //จำนวนที่ต้องสั่ง = ค้างส่ง - (สต๊อก + ค้างรับ)
                          //100   -  (500 + 0) = -400 เงื่อนไข OE ก่อน PR
                          //100   -  (50 + 0) = 50 เงื่อนไข OE ก่อน PR
                          //100   -  (100 + 0) = 0  เงื่อนไข OE ก่อน PR
                          //-------------------------------------------------
                          //0   -  (0 + 0) = 0 เงื่อนไข PR ก่อน OE
                          //0   -  (0 + 100) = -100 เงื่อนไข PR ก่อน OE
                          //100   -  (0 + 100) = 0 เงื่อนไข PR ก่อน OE
                          //0   -  (100 + 0) = -100 เงื่อนไข PR ก่อน OE
                          //100   -  (100 + 0) = 0 เงื่อนไข PR ก่อน OE
          $amount_order = $product->pending_out - ($product->amount_in_stock + $product->pending_in);
          if( $hasX ){
            $list[] = [
                "product_id" => $request->input('product_id_edit')[$i],
                "amount" => $request->input('amount_edit')[$i],
                "discount_price" => $request->input('discount_price_edit')[$i],
                "purchase_requisition_id" => $id,
            ];
          }else if($amount_order > 0){
            $list[] = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $amount_order,
              "discount_price" => $request->input('discount_price_edit')[$i],
              "purchase_requisition_id" => $id,
            ];
          }

        }
      }
      //print_r($list);
      RequisitionDetailModel::insert($list);

      //IF NO ITEM DELETE PR BY id
      if(count($list) == 0){
        RequisitionModel::destroy($id);
      }

      //return redirect("purchase/purchase_requisition/{$id}/edit");
    }

    public function getNewCode2(){
        $number = RequisitionModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $purchase_requisition_code = "PR{$year}{$month}-{$number}";
        return $purchase_requisition_code;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $data = [
          //QUOTATION
          'table_order' => OrderModel::select_by_id($id),
          'order' => OrderModel::findOrFail($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('order'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'order_id'=> $id,
          //QUOTATION Detail
          'table_order_detail' => OrderDetail2Model::select_by_order_id($id),
          'table_product' => ProductModel::select_all(),
          'mode' => 'show',
      ];
      return view('sales/order/edit',$data);
    }

    public function pdf($id)
    {

      $data = [
          //QUOTATION
          'table_order' => OrderModel::select_by_id($id),
          'order' => OrderModel::findOrFail($id),
          //QUOTATION Detail
          'table_order_detail' => OrderDetail2Model::select_by_order_id($id),
          'total_text' => count(OrderModel::select_by_id($id))>0 ?  Functions::baht_text(OrderModel::select_by_id($id)[0]->total) : "-",
      ];
      //return view('sales/order/edit',$data);

      $pdf = PDF::loadView('sales/order/show',$data);
      return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = [
          //QUOTATION
          'table_order' => OrderModel::select_by_id($id),
          'order' => OrderModel::findOrFail($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('order'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'order_id'=> $id,
          //QUOTATION Detail
          'table_order_detail' => OrderDetail2Model::select_by_order_id($id),
          'table_product' => ProductModel::select_all(),
          'mode' => 'edit',
      ];
      return view('sales/order/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //1.INSERT QUOTATION
      $input = [
        //'order_code' => $order_code,
        'external_reference_id' => $request->input('external_reference_id'),
        'customer_id' => $request->input('customer_id'),
        'debt_duration' => $request->input('debt_duration'),
        'billing_duration' => $request->input('billing_duration'),
        'payment_condition' => $request->input('payment_condition',""),
        'delivery_type_id' => $request->input('delivery_type_id'),
        'tax_type_id' => $request->input('tax_type_id'),
        'delivery_time' => $request->input('delivery_time'),
        'department_id' => $request->input('department_id'),
        'sales_status_id' => $request->input('sales_status_id'),
        'user_id' => $request->input('user_id'),
        'zone_id' => $request->input('zone_id'),
        'remark' => $request->input('remark'),
        'vat' => $request->input('vat'),
        'total_before_vat' => $request->input('total_before_vat',0),
        'vat_percent' => $request->input('vat_percent',7),
        'total' => $request->input('total_after_vat',0),
      ];
      OrderModel::update_by_id($input,$id);

      //UPLOAD FILE P/O
      if ($request->hasFile('po_file')) {
        $folder = "customer/po";
        
        $requestData['po_file'] = $request->file('po_file')->store($folder, 'public');
        //$requestData['po_file'] = "sss.jpg";
        $order = OrderModel::findOrFail($id);
        $order->update($requestData);
      }

      //2.INSERT UPDATE DELETE ORDER DETAIL
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          $id_edit = $request->input('id_edit')[$i];
          $a = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $request->input('amount_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "order_id" => $id,
          ];
          switch($id_edit){
            case "+" :
              OrderDetail2Model::insert($a);
              echo "+<br>";
              break;
            default :
              if($id_edit < 0){
                OrderDetail2Model::delete_by_id(abs($id_edit));
                echo "-<br>";
              }else{
                OrderDetail2Model::update_by_id($a,$id_edit);
                echo "{$id_edit}<br>";
                //print_r($a);
              }
          }
        }
      }

      /*
      //2.DELETE QUOTATION DETAIL FIRST
      OrderDetail2Model::delete_by_order_id($id);
      OrderDetailModel::delete_by_order_id($id);

      //3.INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      //print_r($request->input('product_id_edit'));
      //print_r($request->input('amount_edit'));
      //print_r($request->input('discount_price_edit'));
      //echo $id;
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          $a = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $request->input('amount_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "order_id" => $id,
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            $a["order_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;
        }
      }

      OrderDetail2Model::insert($list);
      OrderDetailModel::insert($list);
*/
      //4.REDIRECT
      return redirect("sales/order/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      OrderModel::delete_by_id($id);
      return redirect("sales/order");
    }
}
