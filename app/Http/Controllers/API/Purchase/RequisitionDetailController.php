<?php

namespace App\Http\Controllers\API\Purchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

//use App\Sales\OrderDetailStatusModel;
//use App\Sales\OrderDetailModel;

use App\Purchase\RequisitionDetailModel;
use App\Purchase\RequisitionDetailStatusModel;


class RequisitionDetailController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  { //FOR SOMEONE

    $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id", 3);
    // $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
    //   ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
    //   ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
    //   ->leftJoin('tb_supplier', 'tb_purchase_requisition_detail.supplier_id', '=', 'tb_supplier.supplier_id')
    //   ->where("tb_purchase_requisition_detail.purchase_requisition_detail_status_id", $purchase_requisition_detail_status_id)
    //   ->where("tb_purchase_requisition_detail.amount", ">", 0)
    //   ->where("tb_purchase_requisition_detail.before_approved_amount", ">", 0)
    //   ->select(DB::raw('*,DATE(datetime) as date'))
    //   ->orderBy('date', 'asc')
    //   ->get();
    $m_date = $request->input("m_date", "");
    $date_begin =  $request->input("date_begin", "");
    $date_end = $request->input("date_end", "");
    //echo is_null($m_date);
    $table_purchase_requisition_detail = [];
    if ($m_date !== "" && $m_date != null) {
      //echo "mdate";
      //echo $m_date;
      $table_purchase_requisition_detail = RequisitionDetailModel::select_search($purchase_requisition_detail_status_id, $m_date);
    } else if ($date_begin !== "" && $date_begin != null) {
      //echo "begin";
      $table_purchase_requisition_detail = RequisitionDetailModel::select_search($purchase_requisition_detail_status_id, $date_begin, $date_end);
    }
    // $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id", 3);

    return response()->json($table_purchase_requisition_detail);
  }

  public function index2(Request $request)
  {
    //USE FOR RC SELECTION
    //FOR PO STEP - DEFAULT IS 4 => DEFINED SUPPLIER
    $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id", 4);
    $table_purchase_requisition_detail = RequisitionDetailModel::select_search2($purchase_requisition_detail_status_id);
    return response()->json($table_purchase_requisition_detail);
  }

  public function index_by_supplier(Request $request, $supplier_id)
  {
    //FOR PO STEP - DEFAULT IS 4 => DEFINED SUPPLIER
    //FOR RECEIVE STEP - 5 => RECEIVE FROM SUPPLIER
    $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id", 4);
    $table_purchase_requisition_detail = RequisitionDetailModel::select_search_by_supplier_id($purchase_requisition_detail_status_id, $supplier_id);
    return response()->json($table_purchase_requisition_detail);
  }
  public function edit_supplier(Request $request)
  {
    $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id", 3);
    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
      ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
      ->leftJoin('tb_supplier', 'tb_purchase_requisition_detail.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where("tb_purchase_requisition_detail.purchase_requisition_detail_status_id", $purchase_requisition_detail_status_id)
      ->where("tb_purchase_requisition_detail.amount", ">", 0)
      // ->where("tb_purchase_requisition_detail.before_approved_amount", ">", 0)
      ->select(DB::raw('*,DATE(datetime) as date'))
      ->orderBy('date', 'asc')
      ->get();
    return response()->json($table_purchase_requisition_detail);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
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
    //
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
