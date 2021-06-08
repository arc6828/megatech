<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionDetailStatusModel;
use App\Purchase\RequisitionModel;
use App\SupplierModel;

class RequisitionDetailController extends Controller
{
  public function index(Request $request)
  {
    $filter = (object)[
      "purchase_requisition_detail_status_id" => $request->input("purchase_requisition_detail_status_id", 3),
      "m_date" => $request->input("m_date", "" . date('Y') . "-" . date('m') . "-" . "01"),
      "date_begin" =>  $request->input("date_begin", ""),
      "date_end" => $request->input("date_end", ""),
    ];
    $data = [
      'table_purchase_requisition_detail_status' => RequisitionDetailStatusModel::all(),
      'filter' => $filter,
    ];
    return view('purchase/requisition_detail/index', $data);
  }

  public function approve(Request $request)
  {
    $purchase_requisition_detail_ids = $request->input('purchase_requisition_detail_ids');
    $selected_purchase_requisition_detail_ids = $request->input('selected_purchase_requisition_detail_ids');
    $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action', "1");

    //IF PARTIAL APPROVE
    for ($i = 0; $i < count($purchase_requisition_detail_ids); $i++) {
      //CHECK IF IS CHECKED LIST
      RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
        ->decrement('before_approved_amount', $approve_amounts[$i]);
      RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
        ->increment('approved_amount', $approve_amounts[$i]);

      if (in_array($purchase_requisition_detail_ids[$i], $selected_purchase_requisition_detail_ids)) {
        //CHECK IF APPROVE < amount
        if ($approve_amounts[$i] < $amounts[$i]) {
          //create unsaved copy รออนุมัติ ครั้งต่อไป
          $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();
          // copy new_purchase_detail
          $new_purchase_detail = $purchase_detail->replicate()->fill([
            'purchase_requisition_detail_status_id' => $action,
          ]);

          $new_purchase_detail->save();
        } elseif ($approve_amounts[$i] == $amounts[$i]) {
          //update RequisitionDetailModel
          RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
            ->update(['purchase_requisition_detail_status_id' => $action]);
        }
      }

      //update
      $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();
      $purchase_id = $purchase_detail->purchase_requisition_id;

      $sum = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids)
        ->where('purchase_requisition_id', $purchase_id)
        ->sum('before_approved_amount');

      if ($sum == 0) {
        //NO ONE LEFT : 9 => ออก Invoice ครบ
        RequisitionModel::where('purchase_requisition_id', $purchase_id)
          ->update(["purchase_status_id" => 1]);
      } else {
        RequisitionModel::where('purchase_requisition_id', $purchase_id)
          ->update(["purchase_status_id" => 3]);
      }
    }


    return redirect()->back();
  }

  public function edit_supplier(Request $request)
  {
    $filter = (object)[
      "purchase_requisition_detail_status_id" => $request->input("purchase_requisition_detail_status_id", 1),
      "m_date" => $request->input("m_date", "" . date('Y') . "-" . date('m') . "-" . "06"),
      "date_begin" =>  $request->input("date_begin", ""),
      "date_end" => $request->input("date_end", ""),
    ];
    
    $data = [
      'table_purchase_requisition_detail_status' => RequisitionDetailStatusModel::select_all(),
      'table_supplier' => SupplierModel::orderBy('supplier_code', 'asc')->get(),
      'filter' => $filter,
    ];
    return view('purchase/requisition_detail/edit_supplier', $data);
  }

  public function update_supplier(Request $request)
  {
    $purchase_requisition_detail_ids = $request->input('purchase_requisition_detail_ids');
    $selected_purchase_requisition_detail_ids = $request->input('selected_purchase_requisition_detail_ids');
    $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action', "1"); //SELECT COMPANY

    //IF PARTIAL APPROVE
    for ($i = 0; $i < count($purchase_requisition_detail_ids); $i++) {
      //CHECK IF IS CHECKED LIST
      if (in_array($purchase_requisition_detail_ids[$i], $selected_purchase_requisition_detail_ids)) {
        //CHECK IF APPROVE < amount
        if ($approve_amounts[$i] < $amounts[$i]) {
          //insert new purchase_requisition detail
          $new_amount = $amounts[$i] - $approve_amounts[$i];
          RequisitionDetailModel::duplicate_by_id($new_amount, $purchase_requisition_detail_ids[$i]);
          //update by approve amount
          RequisitionDetailModel::update_by_id(["amount" => $approve_amounts[$i]], $purchase_requisition_detail_ids[$i]);
        }
      }
    }
    //UPDATE BY SELECTED ITEM : 4 means DEFINED SUPPLIER
    $purchase_requisition_detail_status = 4;
    RequisitionDetailModel::update_purchase_requisition_detail_status_id_by_ids2($action, $selected_purchase_requisition_detail_ids, $purchase_requisition_detail_status);
    return redirect()->back();
  }
}
