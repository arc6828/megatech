<?php
namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\PurchaseOrderModel;
use App\Purchase\PurchaseOrderDetailModel;
use App\Purchase\PurchaseOrderDetailStatusModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_purchase_order = PurchaseOrderModel::select_by_keyword($q);
      $data = [
        //QUOTATION
        'table_purchase_order' => PurchaseOrderModel::select_all(),
        'q' => $request->input('q')
      ];
      return view('purchase_order/purchase_order/index',$data);
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
          'table_purchase_order_status' => PurchaseStatusModel::select_by_category('order'),
          'table_purchase_order_user' => UserModel::select_by_role('purchase_order'),
          //'table_purchase_order_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_purchase_order_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase_order/purchase_order/create',$data);
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
          'purchase_order_code' => $this->getNewCode(),
          'external_reference_id' => $request->input('external_reference_id'),
          'customer_id' => $request->input('customer_id'),
          'debt_duration' => $request->input('debt_duration'),
          'billing_duration' => $request->input('billing_duration'),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time'),
          'department_id' => $request->input('department_id'),
          'purchase_order_status_id' => $request->input('purchase_order_status_id'),
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
          'total' => $request->input('total',0),
      ];
      $id = PurchaseOrderModel::insert($input);

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
              "purchase_order_id" => $id,
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            $a["purchase_order_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;
        }
      }
      PurchaseOrderDetailModel::insert($list);

      return redirect("purchase_order/purchase_order/{$id}/edit");
    }

    public function getNewCode(){
        $number = PurchaseOrderModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $purchase_order_code = "IV{$year}{$month}-{$number}";
        return $purchase_order_code;
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
          'table_purchase_order' => PurchaseOrderModel::select_by_id($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_order_status' => PurchaseStatusModel::select_by_category('order'),
          'table_purchase_order_user' => UserModel::select_by_role('purchase_order'),
          'table_zone' => ZoneModel::select_all(),
          'purchase_order_id'=> $id,
          //QUOTATION Detail
          'table_purchase_order_detail' => PurchaseOrderDetailModel::select_by_purchase_order_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase_order/purchase_order/edit',$data);
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
        //'purchase_order_code' => $purchase_order_code,
        'external_reference_id' => $request->input('external_reference_id'),
        'customer_id' => $request->input('customer_id'),
        'debt_duration' => $request->input('debt_duration'),
        'billing_duration' => $request->input('billing_duration'),
        'payment_condition' => $request->input('payment_condition',""),
        'delivery_type_id' => $request->input('delivery_type_id'),
        'tax_type_id' => $request->input('tax_type_id'),
        'delivery_time' => $request->input('delivery_time'),
        'department_id' => $request->input('department_id'),
        'purchase_order_status_id' => $request->input('purchase_order_status_id'),
        'user_id' => $request->input('user_id'),
        'zone_id' => $request->input('zone_id'),
        'remark' => $request->input('remark'),
        'vat_percent' => $request->input('vat_percent',7),
        'total' => $request->input('total',0),
      ];
      PurchaseOrderModel::update_by_id($input,$id);

      //2.DELETE QUOTATION DETAIL FIRST
      PurchaseOrderDetailModel::delete_by_purchase_order_id($id);

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
              "purchase_order_id" => $id,
          ];
        }
      }

      PurchaseOrderDetailModel::insert($list);

      //4.REDIRECT
      return redirect("purchase_order/purchase_order/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      PurchaseOrderModel::delete_by_id($id);
      return redirect("purchase_order/purchase_order");
    }
}
