<?php
namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\RequisitionModel;
use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionDetailStatusModel;
//use App;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\DepartmentModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;
use App\ProductModel;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$table_purchase_requisition = RequisitionModel::select_by_keyword($q);
      $data = [
        //QUOTATION
        //'table_purchase_requisition' => RequisitionModel::select_all(),
        'table_purchase_requisition' => RequisitionModel::all(),
        'q' => $request->input('q')
      ];
      return view('purchase/requisition/index',$data);
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
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
          'table_purchase_user' => UserModel::select_all(),
          //'table_purchase_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          //QUOTATION DETAIL
          'table_purchase_requisition_detail' => [],
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/requisition/create',$data);
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
          'purchase_requisition_code' => $this->getNewCode(),
          'external_reference_id' => $request->input('external_reference_id'),
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
          'vat_percent' => $request->input('vat_percent',7),
          'total' => $request->input('total',0),
      ];

      //VOID IF HAS CODE (Revision)
      if( !empty($request->input('purchase_requisition_code') ) ){          
        $q = RequisitionModel::where('purchase_requisition_code',$request->input('purchase_requisition_code') )
          ->orderBy('datetime','desc')->first();
        $input['revision'] = $q->revision +1 ;
        $q->purchase_status_id = -1; //-1 means void
        $q->save();
        
        $segments = explode("-",$request->input('purchase_requisition_code'));
        $input['purchase_requisition_code'] = $segments[0]."-".$segments[1]."-R".$input['revision'];
        
      }

      $id = RequisitionModel::insert($input);

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
              "purchase_requisition_id" => $id,
          ];
        }
      }
      //print_r($list);
      RequisitionDetailModel::insert($list);

      return redirect("purchase/requisition/{$id}/edit");
    }

    public function getNewCode(){
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
          'table_purchase_requisition' => RequisitionModel::select_by_id($id),
          'table_customer' => CustomerModel::select_all(),
          'table_delivery_type' => DeliveryTypeModel::select_all(),
          'table_department' => DepartmentModel::select_all(),
          'table_tax_type' => TaxTypeModel::select_all(),
          'table_purchase_status' => PurchaseStatusModel::select_by_category('purchase_requisition'),
          'table_purchase_user' => UserModel::select_all(),
          'table_zone' => ZoneModel::select_all(),
          'purchase_requisition_id'=> $id,
          //QUOTATION Detail
          'table_purchase_requisition_detail' => RequisitionDetailModel::select_by_purchase_requisition_id($id),
          'table_product' => ProductModel::select_all(),
      ];
      return view('purchase/requisition/edit',$data);
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
        //'purchase_requisition_code' => $purchase_requisition_code,
        'external_reference_id' => $request->input('external_reference_id'),
        'customer_id' => $request->input('customer_id'),
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
      RequisitionModel::update_by_id($input,$id);

      //2.DELETE QUOTATION DETAIL FIRST
      RequisitionDetailModel::delete_by_purchase_requisition_id($id);

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
              "purchase_requisition_id" => $id,
          ];
          if( is_numeric($request->input('id_edit')[$i]) ){
            $a["purchase_requisition_detail_id"] = $request->input('id_edit')[$i];
          }
          $list[] = $a;
        }
      }

      RequisitionDetailModel::insert($list);

      //4.REDIRECT
      return redirect("purchase/requisition/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      RequisitionModel::delete_by_id($id);
      return redirect("purchase/requisition");
    }
}
