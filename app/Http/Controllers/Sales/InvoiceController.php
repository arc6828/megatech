<?php
namespace App\Http\Controllers\Sales;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\InvoiceModel;
use App\Sales\InvoiceDetailModel;
use App\Sales\OrderDetailModel;
use App\Sales\OrderModel;
use App\Sales\InvoiceDetailStatusModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;

use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_invoice = InvoiceModel::select_by_keyword($q);
      $table_invoice = (Auth::user()->role === "admin" )?
          InvoiceModel::select_all() :
          InvoiceModel::select_all_by_user_id(Auth::id());

      $data = [
        //QUOTATION
        'table_invoice' => $table_invoice,
        'q' => $request->input('q')
      ];
      return view('sales/invoice/index',$data);
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
          'table_sales_status' => SalesStatusModel::select_by_category('order'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_invoice_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('sales/invoice/create',$data);
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
          'invoice_code' => $this->getNewCode(),
          'external_reference_id' => $request->input('external_reference_id'),
          'internal_reference_id' => $request->input('internal_reference_id'),
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
          //'total' => $request->input('total_before_vat',0),
          'total' => $request->input('total_after_vat',0),
      ];
      $id = InvoiceModel::insert($input);

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
              "amount" => $request->input('amount_edit')[$i],
              "discount_price" => $request->input('discount_price_edit')[$i],
              "invoice_id" => $id,
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            //$a["invoice_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;


          //CHANGE STATUS ORDER DETAIL => 4
          $input_detail2 = [
            "order_detail_status_id" => 4,
          ];
          OrderDetailModel::update_by_id($input_detail2 , $request->input('id_edit')[$i]);


          //CHANGE STATUS ORDER

          $order_code = $request->input('internal_reference_id');
          //$order = OrderModel::where('order_code', $order_code)->first();
          //$order_id = $order->order_id;
          $count = OrderDetailModel::countWaitIV($order_code);
          //if($count == 0){
          if($count == 0){
              //NO ONE LEFT : 9 => ออก Invoice ครบ
              OrderModel:: update_by_id(
                ["sales_status_id"=>"9"],
                $order_code
              );
          }

        }
      }
      InvoiceDetailModel::insert($list);

      return redirect("sales/invoice/{$id}/edit");
    }

    public function getNewCode(){
        $number = InvoiceModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $invoice_code = "IV{$year}{$month}-{$number}";
        return $invoice_code;
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
          'table_invoice' => InvoiceModel::select_by_id($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('order'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'invoice_id'=> $id,
          //QUOTATION Detail
          'table_invoice_detail' => InvoiceDetailModel::select_by_invoice_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      //return view('sales/invoice/edit',$data);

      $pdf = PDF::loadView('sales/invoice/show',$data);
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
          'table_invoice' => InvoiceModel::select_by_id($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_sales_status' => SalesStatusModel::select_by_category('order'),
          //'table_sales_user' => UserModel::select_by_role('sales'),
          'table_sales_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'invoice_id'=> $id,
          //QUOTATION Detail
          'table_invoice_detail' => InvoiceDetailModel::select_by_invoice_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      return view('sales/invoice/edit',$data);
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
        //'invoice_code' => $invoice_code,
        'external_reference_id' => $request->input('external_reference_id'),
        'internal_reference_id' => $request->input('internal_reference_id'),
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
        //'total' => $request->input('total_before_vat',0),
        'total' => $request->input('total_after_vat',0),
      ];
      InvoiceModel::update_by_id($input,$id);

      //2.DELETE QUOTATION DETAIL FIRST
      InvoiceDetailModel::delete_by_invoice_id($id);

      //3.INSERT ALL NEW QUOTATION DETAIL
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
              "invoice_id" => $id,
          ];
        }
      }

      InvoiceDetailModel::insert($list);

      //4.REDIRECT
      return redirect("sales/invoice/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      InvoiceModel::delete_by_id($id);
      return redirect("sales/invoice");
    }
}
