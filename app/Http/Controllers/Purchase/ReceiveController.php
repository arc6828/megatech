<?php
namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\ReceiveModel;
use App\Purchase\ReceiveDetailModel;
use App\Purchase\ReceiveDetailStatusModel;

use App\Purchase\OrderModel;
use App\Purchase\OrderDetailModel;

use App\SupplierModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;
use App\GaurdStock;
use PDF;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_purchase_receive = ReceiveModel::select_by_keyword($q);
      $data = [
        //QUOTATION
        'table_purchase_receive' => ReceiveModel::select_all(),
        'q' => $request->input('q')
      ];
      return view('purchase/receive/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
          //QUOTATION
          'table_supplier' => SupplierModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_order'),
          //'table_purchase_user' => UserModel::select_by_role('purchase_receive'),
          'table_purchase_user' => UserModel::all(),
          //'table_purchase_receive_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_purchase_receive_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/receive/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //INSERT QUOTATION
      $input = [
          'purchase_receive_code' => $this->getNewCode(),
          'external_reference_doc' => $request->input('external_reference_doc'),
          'internal_reference_doc' => $request->input('internal_reference_doc'),
          'supplier_id' => $request->input('supplier_id'),
          'debt_duration' => $request->input('debt_duration'),
          'billing_duration' => $request->input('billing_duration'),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time'),
          'department_id' => $request->input('department_id'),
          //'purchase_status_id' => $request->input('purchase_status_id'),
          'purchase_status_id' => 4, //4 means ปิดการซื้อเรียบร้อย
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
          
          //'vat' => $request->input('vat',0),
          'total_before_vat' => $request->input('total_before_vat',0),
          'total' => $request->input('total_after_vat',0),
          'total_debt' => $request->input('total_after_vat',0),
      ];

      //UPLOAD
      $id = ReceiveModel::insert($input);

      //UPLOAD FILE P/O
      $receive = ReceiveModel::findOrFail($id);
      //UPLOAD FILE P/O      
      if ($request->hasFile('file')) {
        $folder = "supplier/iv";
        
        $requestData['file'] = $request->file('file')->store($folder, 'public');
        $requestData['external_reference_doc'] = $request->input('external_reference_doc');
        //$requestData['file'] = "sss.jpg";
        $receive->update($requestData);
      }    

      //INSERT ALL NEW QUOTATION DETAIL
      $list = [];
      //print_r($request->input('product_id_edit'));
      //print_r($request->input('amount_edit'));
      //print_r($request->input('discount_price_edit'));
      //echo $id;
      if (is_array ($request->input('product_id_edit'))){
        for($i=0; $i<count($request->input('product_id_edit')); $i++){
          $a = [
              "product_id" => $request->input('product_id_edit')[$i],
              "amount" => $request->input('amount_receive_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "purchase_receive_id" => $id,
              "purchase_order_detail_id" =>  $request->input('purchase_order_detail_id_edit')[$i],
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            //$a["purchase_receive_detail_id"] = $request->input('id_edit')[$i];
          }
          $amount_receive = $request->input('amount_receive_edit')[$i];
          if($amount_receive > 0){
            $list[] = $a;

            //UPDATE PO Detail  : amount_pending_in, status if amount_pending_in
            $order_detail_id = $request->input('id_edit')[$i];
            $amount_receive = $request->input('amount_receive_edit')[$i];
            $amount_pending_in = $request->input('amount_pending_edit')[$i];
            if($amount_pending_in == $amount_receive){
              //STATUS 6 MEANS RECEIVED
              OrderDetailModel::update_by_id(["purchase_order_detail_status_id"=>6], $order_detail_id);
            }
            //THIS MEANS COMPLETE
            OrderDetailModel::decreaseAmountPendingIn($amount_receive, $order_detail_id);
          }
        }
      }
      ReceiveDetailModel::insert($list);

      //CHECK if ALL RECEIVED, UPDATE STATUS PO : 4 => ปิดการซื้อเรียบร้อย
      $purchase_order_code = $request->input('internal_reference_doc');
      echo $purchase_order_code;

      $purchase_order = OrderModel::where('purchase_order_code', $purchase_order_code)->first();
      $purchase_order_id = $purchase_order->purchase_order_id;
      $count = OrderDetailModel::countNotReceive($purchase_order_id);
      if($count == 0){
          //NO ONE LEFT : 4 => ปิดการซื้อเรียบร้อย
          OrderModel:: update_by_id(
            ["purchase_status_id"=>"4"],
            $purchase_order_id
          );
      }

      //GAURD STOCK      
      foreach($list as $item){
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $item['purchase_receive_id'],
          "type" => "purchase_receive",
          "amount" => $item['amount'],
          "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
          "pending_in" => ($product->pending_in - $item['amount'] ),
          "pending_out" => ($product->pending_out),
          "product_id" => $product->product_id,
        ]);
        
        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();

      }




      return redirect("purchase/receive/{$id}");
    }

    public function getNewCode(){
        $number = ReceiveModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $purchase_receive_code = "RC{$year}{$month}-{$number}";
        return $purchase_receive_code;
    }

    public function cancel($id)
    {
      //
      $purchase_receive = ReceiveModel::findOrFail($id);
      //VOID
      $purchase_receive->purchase_status_id = -1; //-1 MEANS Void    
      $purchase_receive->save();     
      
      //FIND OE
      $order = OrderModel::where('purchase_order_code',$purchase_receive->internal_reference_doc)->firstOrFail();
      //RE STATUS OE 
      if($order->purchase_status_id == 4){ //4 : ปิดการซื้อเรียบร้อย
        $order->update(["purchase_status_id"=>"3"]); //3 : รอรับสินค้า
      }

      

      $list = $purchase_receive->purchase_receive_details()->get();

      //RE STATUS OE DETAIL IN PICKING
      //$pickings = $order->pickings()->get();
      foreach($list as $p){
        //UPDATE AMOUNT_PENDING_IN
        $order_detail = OrderDetailModel::findOrFail($p->purchase_order_detail_id);
        //->where('product_id',$p->product_id)
        // ->where('purchase_order_detail_id',$p->purchase_order_detail_id)
        // ->where('purchase_order_detail_status_id','6') //6 รับสินค้าแล้ว
        // ;
        // print_r($order->order_details()->get());
        // print_r($p);

        $order_detail->increment('amount_pending_in', $p->amount);

        //UPDATE STATUS
        $order_detail->update(["purchase_order_detail_status_id" => "5"]); //6 รับสินค้าแล้ว -> 5 ออก PO แล้ว
          
      }


        
      
      //GAURD STOCK     - CHECK 
      foreach($list as $item){
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $id,
          "type" => "sales_invoice_cancel",
          "amount" => $item['amount'],
          "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
          "pending_in" => ($product->pending_in +  $item['amount'] ),
          "pending_out" => ($product->pending_out ),
          "product_id" => $product->product_id,
        ]);
        
        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();

      }

      return redirect("purchase/receive/{$id}");
    }

    public function pdf($id)
    {
        //no show
      $data = [
          //QUOTATION
          'table_purchase_receive' => ReceiveModel::select_by_id($id),
          'table_supplier' => SupplierModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
          'table_purchase_user' => UserModel::all(),
          'table_zone' => ZoneModel::select_all(),
          'purchase_receive_id'=> $id,
          //QUOTATION Detail
          'table_purchase_receive_detail' => ReceiveDetailModel::select_by_purchase_receive_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      //return view('purchase/receive/edit',$data);

      $pdf = PDF::loadView('purchase/receive/show',$data);
      return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
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
        'table_purchase_receive' => ReceiveModel::select_by_id($id),
        'purchase_receive' => ReceiveModel::findOrFail($id),
        'table_supplier' => SupplierModel::select_all(),
        'table_delivery_type' => DeliveryTypeModel::select_all(),
        'table_department' => DepartmentModel::select_all(),
        'table_tax_type' => TaxTypeModel::select_all(),
        'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
        'table_purchase_user' => UserModel::all(),
        'table_zone' => ZoneModel::select_all(),
        'purchase_receive_id'=> $id,
        'mode' => 'show',
        //QUOTATION Detail
        'table_purchase_receive_detail' => ReceiveDetailModel::select_by_purchase_receive_id($id),
        'table_product' => ProductModel::select_all(),
      ];
      //echo $data["mode"];
      //exit();
      return view('purchase/receive/edit',$data);
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
          'table_purchase_receive' => ReceiveModel::select_by_id($id),
          'purchase_receive' => ReceiveModel::findOrFail($id),
          'table_supplier' => SupplierModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
          'table_purchase_user' => UserModel::all(),
          'table_zone' => ZoneModel::select_all(),
          'purchase_receive_id'=> $id,
          'mode' => 'edit',
          //QUOTATION Detail
          'table_purchase_receive_detail' => ReceiveDetailModel::select_by_purchase_receive_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/receive/edit',$data);
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
      // //1.INSERT QUOTATION
      // $input = [
      //   //'purchase_receive_code' => $purchase_receive_code,
      //   'external_reference_doc' => $request->input('external_reference_doc'),
      //   'supplier_id' => $request->input('supplier_id'),
      //   'debt_duration' => $request->input('debt_duration'),
      //   'billing_duration' => $request->input('billing_duration'),
      //   'payment_condition' => $request->input('payment_condition',""),
      //   'delivery_type_id' => $request->input('delivery_type_id'),
      //   'tax_type_id' => $request->input('tax_type_id'),
      //   'delivery_time' => $request->input('delivery_time'),
      //   'department_id' => $request->input('department_id'),
      //   'purchase_status_id' => $request->input('purchase_status_id'),
      //   'user_id' => $request->input('user_id'),
      //   'zone_id' => $request->input('zone_id'),
      //   'remark' => $request->input('remark'),
      //   'vat_percent' => $request->input('vat_percent',7),
      //   'total' => $request->input('total',0),
      // ];
      // ReceiveModel::update_by_id($input,$id);

      // //2.DELETE QUOTATION DETAIL FIRST
      // ReceiveDetailModel::delete_by_purchase_receive_id($id);

      // //3.INSERT ALL NEW QUOTATION DETAIL
      // $list = [];
      // //print_r($request->input('product_id_edit'));
      // //print_r($request->input('amount_edit'));
      // //print_r($request->input('discount_price_edit'));
      // //echo $id;
      // if (is_array ($request->input('product_id_edit'))){
      //   for($i=0; $i<count($request->input('product_id_edit')); $i++){
      //     $list[] = [
      //         "product_id" => $request->input('product_id_edit')[$i],
      //         "amount" => $request->input('amount_edit')[$i],
      //         "discount_price" => $request->input('discount_price_edit')[$i],
      //         "purchase_receive_id" => $id,
      //     ];
      //   }
      // }

      // ReceiveDetailModel::insert($list);
      
      $receive = ReceiveModel::findOrFail($id);

      //UPLOAD FILE P/O      
      if ($request->hasFile('file')) {
        $folder = "supplier/iv";
        
        $requestData['file'] = $request->file('file')->store($folder, 'public');
        $requestData['external_reference_doc'] = $request->input('external_reference_doc');
        //$requestData['file'] = "sss.jpg";
        $receive->update($requestData);
      }      
      $requestData['external_reference_doc'] = $request->input('external_reference_doc');
      //exit();
      //UPDATE PR Detail
      
      // $requestData['external_reference_doc'] = '555';      
      $receive->update($requestData);

      //4.REDIRECT
      return redirect("purchase/receive/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      ReceiveModel::delete_by_id($id);
      return redirect("purchase/receive");
    }
}
