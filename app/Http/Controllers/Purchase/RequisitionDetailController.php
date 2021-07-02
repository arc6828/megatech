<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase\OrderDetailModel;
use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionDetailStatusModel;
// use App\Purchase\RequisitionModel;
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
    // $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action', "1");

    for ($i = 0; $i < count($purchase_requisition_detail_ids); $i++) {
      //CHECK IF IS CHECKED LIST
      if (in_array($purchase_requisition_detail_ids[$i], $selected_purchase_requisition_detail_ids)) {

        RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
          ->decrement('before_approved_amount', $approve_amounts[$i]);
        RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
          ->increment('approved_amount', $approve_amounts[$i]);

        RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
          ->update(['purchase_requisition_detail_status_id' => $action]);
      }
    }
    return redirect()->back();
  }
  // $sum = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids)
  //   ->where('purchase_requisition_id', $purchase_id)
  //   ->sum('before_approved_amount');

  // if ($sum == 0) {
  //   RequisitionModel::where('purchase_requisition_id', $purchase_id)
  //     ->update(["purchase_status_id" => 1]);
  // } else {
  //   RequisitionModel::where('purchase_requisition_id', $purchase_id)
  //     ->update(["purchase_status_id" => 3]);
  // }

  //   $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();

  //   RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_detail->purchase_requisition_detail_id)->first()
  //     ->update(['supplier_amount' => $purchase_detail->approved_amount]);

  //   //CHECK IF APPROVE < amount PARTIAL APPROVE
  //   if ($approve_amounts[$i] < $amounts[$i]) {
  //     //create unsaved copy รออนุมัติ ครั้งต่อไป
  //     $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();
  //     // copy new_purchase_detail
  //     $new_purchase_detail = $purchase_detail->replicate()->fill([
  //       'purchase_requisition_detail_status_id' => $action,
  //     ]);
  //     $new_purchase_detail->save();
  //   } elseif ($approve_amounts[$i] == $amounts[$i]) {
  //     //update RequisitionDetailModel
  //     RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
  //       ->update(['purchase_requisition_detail_status_id' => $action]);
  //   }
  // }

  //update RequisitionModel
  // $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();
  // $purchase_id = $purchase_detail->purchase_requisition_id;

  // $count = RequisitionDetailModel::where('purchase_requisition_detail_status_id', 3) // รออนุมัติ
  //   ->where('purchase_requisition_id', $purchase_id)
  //   ->count();

  // if ($count == 0) {
  //   RequisitionModel::where('purchase_requisition_id', $purchase_id)
  //     ->update(["purchase_status_id" => 3]);
  // }
  public function edit_supplier(Request $request)
  {
    $filter = (object)[
      "purchase_requisition_detail_status_id" => $request->input("purchase_requisition_detail_status_id", 1),
      "m_date" => $request->input("m_date", "" . date('Y') . "-" . date('m') . "-" . "06"),
      "date_begin" =>  $request->input("date_begin", ""),
      "date_end" => $request->input("date_end", ""),
    ];

    $data = [
      'table_purchase_requisition_detail_status' => RequisitionDetailStatusModel::all(),
      'table_supplier' => SupplierModel::orderBy('supplier_code', 'asc')->get(),
      'filter' => $filter,
    ];
    return view('purchase/requisition_detail/edit_supplier', $data);
  }

  public function update_supplier(Request $request)
  {
    $purchase_requisition_detail_ids = $request->input('purchase_requisition_detail_ids');
    $selected_purchase_requisition_detail_ids = $request->input('selected_purchase_requisition_detail_ids');
    // $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action', "1"); //SELECT COMPANY

    //IF PARTIAL APPROVE
    for ($i = 0; $i < count($purchase_requisition_detail_ids); $i++) {
      //CHECK IF IS CHECKED LIST
      if (in_array($purchase_requisition_detail_ids[$i], $selected_purchase_requisition_detail_ids)) {

        RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
          ->decrement('approved_amount', $approve_amounts[$i]);
        //decrement supplier_amount 
        RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
          ->increment('supplier_amount', $approve_amounts[$i]);

        RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first()
          ->update([
            'supplier_id' => $action,
            'purchase_requisition_detail_status_id' => 4,
          ]);

        $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();

        $order_detail = OrderDetailModel::create([
          "product_id" => $purchase_detail->product_id,
          "amount" => $purchase_detail->supplier_amount,
          "requisition_detail_id" => $purchase_detail->purchase_requisition_detail_id,
          "supplier_id" => $purchase_detail->supplier_id,
          "purchase_order_detail_status_id" => 5,
        ]);
        $order_detail->save();
        // if ($approve_amounts[$i] < $amounts[$i]) {
        //   $purchase_detail = RequisitionDetailModel::where('purchase_requisition_detail_id', $purchase_requisition_detail_ids[$i])->first();
        //   $new_purchase_detail = $purchase_detail->replicate()->fill([
        //     'purchase_requisition_detail_status_id' => 1,
        //   ]);
        //   $new_purchase_detail->save();
        // }
      }
    }
    return redirect()->back();
  }
}
