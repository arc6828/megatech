<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionDetailStatusModel;

use App\SupplierModel;

class RequisitionDetailController extends Controller
{
  public function index(Request $request)
  {
    $filter = (object)[
      "purchase_requisition_detail_status_id" => $request->input("purchase_requisition_detail_status_id",3),
      "m_date" => $request->input("m_date", "".date('Y')."-".date('m')."-"."01"),
      "date_begin" =>  $request->input("date_begin",""),
      "date_end" => $request->input("date_end",""),
    ];
    $data = [
      'table_purchase_requisition_detail_status' => RequisitionDetailStatusModel::select_all(),
      'filter' => $filter,
    ];
    return view('purchase/requisition_detail/index',$data);
  }

  public function approve(Request $request)
  {
    $purchase_requisition_detail_ids = $request->input('purchase_requisition_detail_ids');
    $selected_purchase_requisition_detail_ids = $request->input('selected_purchase_requisition_detail_ids');
    $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action',"1");

    //IF PARTIAL APPROVE
    for($i=0; $i<count($purchase_requisition_detail_ids); $i++){
      //CHECK IF IS CHECKED LIST
      if(in_array($purchase_requisition_detail_ids[$i],$selected_purchase_requisition_detail_ids)){
        //CHECK IF APPROVE < amount
        if($approve_amounts[$i] < $amounts[$i]){
          //insert new purchase_requisition detail for ไม่อนุมุติ
          $new_amount = $amounts[$i] - $approve_amounts[$i];
          $id = RequisitionDetailModel::duplicate_by_id($new_amount, $purchase_requisition_detail_ids[$i]);
          //IF NOT
          $r = RequisitionDetailModel::findOrFail($id);
          $r->purchase_requisition_detail_status_id = 2; //2 means ไม่อนุมัติ
          $r->save();

          //update by approve amount อนุมัติ
          RequisitionDetailModel::update_by_id(["amount"=>$approve_amounts[$i]] , $purchase_requisition_detail_ids[$i]);
        }
      }
    }
    RequisitionDetailModel::update_purchase_requisition_detail_status_id_by_ids($action, $selected_purchase_requisition_detail_ids,3);
    return redirect()->back();
  }

  public function edit_supplier(Request $request)
  {
    $filter = (object)[
      "purchase_requisition_detail_status_id" => $request->input("purchase_requisition_detail_status_id",1),
      "m_date" => $request->input("m_date", "".date('Y')."-".date('m')."-"."01"),
      "date_begin" =>  $request->input("date_begin",""),
      "date_end" => $request->input("date_end",""),
    ];
    $data = [
      'table_purchase_requisition_detail_status' => RequisitionDetailStatusModel::select_all(),
      'table_supplier' => SupplierModel::orderBy('supplier_code','asc')->get(),
      'filter' => $filter,
    ];
    return view('purchase/requisition_detail/edit_supplier',$data);
  }

  public function update_supplier(Request $request)
  {
    $purchase_requisition_detail_ids = $request->input('purchase_requisition_detail_ids');
    $selected_purchase_requisition_detail_ids = $request->input('selected_purchase_requisition_detail_ids');
    $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action',"1"); //SELECT COMPANY

    //IF PARTIAL APPROVE
    for($i=0; $i<count($purchase_requisition_detail_ids); $i++){
      //CHECK IF IS CHECKED LIST
      if(in_array($purchase_requisition_detail_ids[$i],$selected_purchase_requisition_detail_ids)){
        //CHECK IF APPROVE < amount
        if($approve_amounts[$i] < $amounts[$i]){
          //insert new purchase_requisition detail
          $new_amount = $amounts[$i] - $approve_amounts[$i];
          RequisitionDetailModel::duplicate_by_id($new_amount, $purchase_requisition_detail_ids[$i]);
          //update by approve amount
          RequisitionDetailModel::update_by_id(["amount"=>$approve_amounts[$i]] , $purchase_requisition_detail_ids[$i]);
        }
      }
    }
    //UPDATE BY SELECTED ITEM : 4 means DEFINED SUPPLIER
    $purchase_requisition_detail_status = 4;
    RequisitionDetailModel::update_purchase_requisition_detail_status_id_by_ids2($action, $selected_purchase_requisition_detail_ids, $purchase_requisition_detail_status);
    return redirect()->back();
  }
}
