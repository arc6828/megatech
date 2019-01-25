<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\PurchaseRequisitionDetailModel;
use App\Purchase\PurchaseRequisitionDetailStatusModel;

class PurchaseRequisitionDetailController extends Controller
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
      'table_purchase_requisition_detail_status' => PurchaseRequisitionDetailStatusModel::select_all(),
      'filter' => $filter,
    ];
    return view('purchase/purchase_requisition_detail/index',$data);
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
          //insert new purchase_requisition detail
          $new_amount = $amounts[$i] - $approve_amounts[$i];
          PurchaseRequisitionDetailModel::duplicate_by_id($new_amount, $purchase_requisition_detail_ids[$i]);
          //update by approve amount
          PurchaseRequisitionDetailModel::update_by_id(["amount"=>$approve_amounts[$i]] , $purchase_requisition_detail_ids[$i]);
        }
      }
    }
    PurchaseRequisitionDetailModel::update_purchase_requisition_detail_status_id_by_ids($action, $selected_purchase_requisition_detail_ids);
    return redirect()->back();
  }
}
