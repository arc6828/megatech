<?php
namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\PurchaseRequisitionModel;
use App\Purchase\PurchaseRequisitionDetailModel;

use App\CustomerModel;
use App\DeliveryTypeModel;
use App\TaxTypeModel;
use App\PurchaseStatusModel;
use App\UserModel;
use App\ZoneModel;

class PurchaseRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //QUOTATION
        $q = $request->input('q');
        $table_purchase_requisition = PurchaseRequisitionModel::select_by_keyword($q);
        //QUATATION DETAIL

        $data = [
            'table_purchase_requisition' => $table_purchase_requisition,
            'q' => $q
        ];
        return view('purchase/purchase_requisition/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table_customer = CustomerModel::select_all();
        $table_delivery_type = DeliveryTypeModel::select_all();
        $table_tax_type = TaxTypeModel::select_all();
        $table_purchase_status = PurchaseStatusModel::select_all();
        $table_purchase_user = UserModel::select_by_role('purchase');
        $table_zone = ZoneModel::select_all();

        $data = [
            'table_customer' => $table_customer,
            'table_delivery_type' => $table_delivery_type,
            'table_tax_type' => $table_tax_type,
            'table_purchase_status' => $table_purchase_status,
            'table_purchase_user' => $table_purchase_user,
            'table_zone' => $table_zone,
        ];
        return view('purchase/purchase_requisition/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase_requisition_code = $this->getNewCode();
        $input = [
            'purchase_requisition_code' => $purchase_requisition_code,
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
        ];
        $id = PurchaseRequisitionModel::insert($input);
        return redirect("purchase/purchase_requisition/{$id}/edit");
    }

    public function getNewCode(){
        $count = PurchaseRequisitionModel::select_count_by_current_month() + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $purchase_requisition_code = "QT{$year}{$month}-{$number}";
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
        $table_purchase_requisition = PurchaseRequisitionModel::select_by_id($id);
        $table_customer = CustomerModel::select_all();
        $table_delivery_type = DeliveryTypeModel::select_all();
        $table_tax_type = TaxTypeModel::select_all();
        $table_purchase_status = PurchaseStatusModel::select_all();
        $table_purchase_user = UserModel::select_by_role('purchase');
        $table_zone = ZoneModel::select_all();
        $table_purchase_requisition_detail = PurchaseRequisitionDetailModel::select_by_purchase_requisition_id($id);

        $data = [
            'table_purchase_requisition' => $table_purchase_requisition,
            'table_customer' => $table_customer,
            'table_delivery_type' => $table_delivery_type,
            'table_tax_type' => $table_tax_type,
            'table_purchase_status' => $table_purchase_status,
            'table_purchase_user' => $table_purchase_user,
            'table_zone' => $table_zone,
            'table_purchase_requisition_detail' => $table_purchase_requisition_detail,
            'purchase_requisition_id'=> $id,
        ];
        return view('purchase/purchase_requisition/edit',$data);
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
      $input = [
          //'purchase_requisition_code' => $purchase_requisition_code,
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
      ];
      PurchaseRequisitionModel::update_by_id($input,$id);
      return redirect("purchase/purchase_requisition/{$id}/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
