<?php
namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\OrderModel;
use App\Purchase\OrderDetailModel;
use App\Purchase\OrderDetailStatusModel;

use App\SupplierModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_purchase_order = OrderModel::select_by_keyword($q);
      $data = [
        //QUOTATION
        'table_purchase_order' => OrderModel::select_all(),
        'q' => $request->input('q')
      ];
      return view('purchase/order/index',$data);
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
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
          //'table_purchase_user' => UserModel::select_by_role('purchase_order'),
          'table_purchase_user' => UserModel::all(),
          //'table_purchase_order_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_purchase_order_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/order/create',$data);
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
          'external_reference_doc' => $request->input('external_reference_doc'),
          'supplier_id' => $request->input('supplier_id'),
          'debt_duration' => $request->input('debt_duration'),
          'billing_duration' => $request->input('billing_duration'),
          'payment_condition' => $request->input('payment_condition',""),
          'delivery_type_id' => $request->input('delivery_type_id'),
          'tax_type_id' => $request->input('tax_type_id'),
          'delivery_time' => $request->input('delivery_time'),
          'department_id' => $request->input('department_id'),
          'purchase_status_id' => $request->input('purchase_status_id'),
          'user_id' => $request->input('user_id'),
          'zone_id' => $request->input('zone_id'),
          'remark' => $request->input('remark'),
          'vat_percent' => $request->input('vat_percent',7),
          'total' => $request->input('total',0),
      ];
      $id = OrderModel::insert($input);

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
              "purchase_order_detail_status_id" => 5, //5 : ออก PO แล้ว
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            //$a["purchase_order_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;
        }
      }
      OrderDetailModel::insert($list);

      //UPDATE PR Detail

      return redirect("purchase/order/{$id}/edit");
    }

    public function getNewCode(){
        $number = OrderModel::select_count_by_current_month();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $purchase_order_code = "PO{$year}{$month}-{$number}";
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
          'table_purchase_order' => OrderModel::select_by_id($id),
          'table_supplier' => SupplierModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
          'table_purchase_user' => UserModel::all(),
          'table_zone' => ZoneModel::select_all(),
          'purchase_order_id'=> $id,
          //QUOTATION Detail
          'table_purchase_order_detail' => OrderDetailModel::select_by_purchase_order_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/order/edit',$data);
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
        'external_reference_doc' => $request->input('external_reference_doc'),
        'supplier_id' => $request->input('supplier_id'),
        'debt_duration' => $request->input('debt_duration'),
        'billing_duration' => $request->input('billing_duration'),
        'payment_condition' => $request->input('payment_condition',""),
        'delivery_type_id' => $request->input('delivery_type_id'),
        'tax_type_id' => $request->input('tax_type_id'),
        'delivery_time' => $request->input('delivery_time'),
        'department_id' => $request->input('department_id'),
        'purchase_status_id' => $request->input('purchase_status_id'),
        'user_id' => $request->input('user_id'),
        'zone_id' => $request->input('zone_id'),
        'remark' => $request->input('remark'),
        'vat_percent' => $request->input('vat_percent',7),
        'total' => $request->input('total',0),
      ];
      OrderModel::update_by_id($input,$id);

      //2.DELETE QUOTATION DETAIL FIRST
      OrderDetailModel::delete_by_purchase_order_id($id);

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
              "purchase_order_detail_status_id" => 5, //5 : ออก PO แล้ว
          ];
        }
      }

      OrderDetailModel::insert($list);

      //UPDATE PR Detail

      //4.REDIRECT
      return redirect("purchase/order/{$id}/edit");
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
      return redirect("purchase/order");
    }
}
