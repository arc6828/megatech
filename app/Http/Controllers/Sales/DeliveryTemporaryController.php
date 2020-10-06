<?php
namespace App\Http\Controllers\Sales;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\DeliveryTemporaryModel;
use App\Sales\DeliveryTemporaryDetailModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;
use App\GaurdStock;

use PDF;

class DeliveryTemporaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_delivery_temporary = DeliveryTemporaryModel::select_by_keyword($q);
      $table_delivery_temporary = (Auth::user()->role === "admin" )?
          DeliveryTemporaryModel::select_all() :
          DeliveryTemporaryModel::select_all_by_user_id(Auth::id());

      $data = [
        //QUOTATION
        'table_delivery_temporary' => $table_delivery_temporary,
        'q' => $request->input('q')
      ];
      return view('sales/delivery_temporary/index',$data);
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
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('delivery_temporary'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_delivery_temporary_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('sales/delivery_temporary/create',$data);
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
          'delivery_temporary_code' => $this->getNewCode(),
          'customer_id' => $request->input('customer_id'),
          'debt_duration' => $request->input('debt_duration',"0"),
          'billing_duration' => $request->input('billing_duration',"0"),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time',"0"),
          'department_id' => $request->input('department_id'),
          'sales_status_id' => 10, //default is 10 สร้างใบส่งของชั่วคราว
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id','0'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
          'total' => $request->input('total_after_vat',0),
      ];
      //print_r($input);
      //exit();
      //VOID IF HAS CODE (Revision)
      if( !empty($request->input('delivery_temporary_code') ) ){
        switch($request->input('delivery_temporary_code')){
          case "DTDRAFT" : 
            $id =   $request->input('delivery_temporary_id');
            DeliveryTemporaryModel::destroy($id);
            DeliveryTemporaryDetailModel::where('delivery_temporary_id',$id)->delete();
            break;
          default :
            $q = DeliveryTemporaryModel::where('delivery_temporary_code',$request->input('delivery_temporary_code') )
              ->orderBy('datetime','desc')->first();
            $input['revision'] = $q->revision +1 ;
            $q->sales_status_id = -1; //-1 means void
            $q->save();
            
            $segments = explode("-",$request->input('delivery_temporary_code'));
            $input['delivery_temporary_code'] = $segments[0]."-".$segments[1]."-R".$input['revision'];
        }
        
        
      }
      //DRAFT
      if($input['sales_status_id'] == 0 )
      {
        //0 means DRART -> do not set quotation_code / date
        $input['delivery_temporary_code'] = "DTDRAFT";
        $input['datetime'] = "";

      }
      $id = DeliveryTemporaryModel::insert($input);

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
              "delivery_temporary_id" => $id,
          ];
        }
      }
      DeliveryTemporaryDetailModel::insert($list);

      //GAURD STOCK      
      foreach($list as $item){
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $id,
          "type" => "sales_dt_create",
          "amount" => $item['amount'],
          "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
          "pending_in" => $product->pending_in,
          "pending_out" => $product->pending_out,
          "product_id" => $product->product_id,
        ]);
        
        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();

      }

      return redirect("sales/delivery_temporary/{$id}/edit");
    }

    public function getNewCode(){
        $number = DeliveryTemporaryModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $delivery_temporary_code = "DT{$year}{$month}-{$number}";
        return $delivery_temporary_code;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //no show

      $data = [
          //QUOTATION
          'table_delivery_temporary' => DeliveryTemporaryModel::select_by_id($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('delivery_temporary'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'delivery_temporary_id'=> $id,
          //QUOTATION Detail
          'table_delivery_temporary_detail' => DeliveryTemporaryDetailModel::select_by_delivery_temporary_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      //return view('sales/delivery_temporary/edit',$data);

      $pdf = PDF::loadView('sales/delivery_temporary/show',$data);
      return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }

    public function pdf($id)
    {
        //no show

      $data = [
          //QUOTATION
          'table_delivery_temporary' => DeliveryTemporaryModel::select_by_id($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('delivery_temporary'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'delivery_temporary_id'=> $id,
          //QUOTATION Detail
          'table_delivery_temporary_detail' => DeliveryTemporaryDetailModel::select_by_delivery_temporary_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      //return view('sales/delivery_temporary/edit',$data);

      $pdf = PDF::loadView('sales/delivery_temporary/show',$data);
      return $pdf->stream('test.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }

    public function cancel($id)
    {
      //
      $delivery_temporary = DeliveryTemporaryModel::findOrFail($id);
      $delivery_temporary->sales_status_id = 11; //11 MEANS Cancelled
      $delivery_temporary->save();      
      $list = $delivery_temporary->delivery_temporary_details;
      
      //GAURD STOCK      
      foreach($list as $item){
        $product = ProductModel::findOrFail($item['product_id']);
        $gaurd_stock = GaurdStock::create([
          "code" => $id,
          "type" => "sales_dt_cancel",
          "amount" => $item['amount'],
          "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
          "pending_in" => $product->pending_in,
          "pending_out" => $product->pending_out,
          "product_id" => $product->product_id,
        ]);
        
        //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
        $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
        $product->pending_in = $gaurd_stock['pending_in'];
        $product->pending_out = $gaurd_stock['pending_out'];
        $product->save();

      }

      return redirect("sales/delivery_temporary/{$id}/edit");
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
          'table_delivery_temporary' => DeliveryTemporaryModel::select_by_id($id),
          'delivery_temporary' => DeliveryTemporaryModel::findOrFail($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('delivery_temporary'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'delivery_temporary_id'=> $id,
          //QUOTATION Detail
          'table_delivery_temporary_detail' => DeliveryTemporaryDetailModel::select_by_delivery_temporary_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      return view('sales/delivery_temporary/edit',$data);
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
        //'delivery_temporary_code' => $delivery_temporary_code,
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
        'total' => $request->input('total_after_vat',0),
      ];
      DeliveryTemporaryModel::update_by_id($input,$id);

      //2.DELETE QUOTATION DETAIL FIRST
      DeliveryTemporaryDetailModel::delete_by_delivery_temporary_id($id);

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
              "delivery_temporary_id" => $id,
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            $a["delivery_temporary_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;
        }
      }

      DeliveryTemporaryDetailModel::insert($list);
      //print_r($list);

      //4.REDIRECT
      return redirect("sales/delivery_temporary/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DeliveryTemporaryModel::delete_by_id($id);
      return redirect("sales/delivery_temporary");
    }




}
