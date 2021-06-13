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
  {
    //ใช้ตอน อนุมัติใบเสนอซื้อ
    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
      ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
      ->leftJoin('tb_supplier', 'tb_purchase_requisition_detail.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where("tb_purchase_requisition_detail.amount", ">", 0)
      ->where("tb_purchase_requisition_detail.before_approved_amount", ">", 0)
      ->select(DB::raw('*,DATE(datetime) as date'))
      ->orderBy('date', 'asc')
      ->get();

    return response()->json($table_purchase_requisition_detail);
  }

  public function index2(Request $request)
  {
    //USE FOR RC SELECTION
    //FOR PO STEP - DEFAULT IS 4 => DEFINED SUPPLIER
    //แสดงผลใน model order/create
    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
      ->join('tb_supplier', 'tb_supplier.supplier_id', '=', 'tb_purchase_requisition_detail.supplier_id')
      ->join('tb_purchase_order_detail', 'tb_purchase_order_detail.supplier_id', '=', 'tb_purchase_requisition_detail.supplier_id')
      ->whereNull('tb_purchase_order_detail.purchase_order_id')
      ->where("tb_purchase_requisition_detail.po_amount", "=", 0)
      ->get();
    return response()->json($table_purchase_requisition_detail);
  }

  public function index_by_supplier(Request $request, $supplier_id)
  {
    //FOR PO STEP - DEFAULT IS 4 => DEFINED SUPPLIER
    //FOR RECEIVE STEP - 5 => RECEIVE FROM SUPPLIER
    //แสดงผลหน้า order/create
    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
      ->join('tb_supplier', 'tb_supplier.supplier_id', '=', 'tb_purchase_requisition_detail.supplier_id')
      ->join('tb_purchase_order_detail', 'tb_purchase_order_detail.supplier_id', '=', 'tb_purchase_requisition_detail.supplier_id')
      ->whereNull('tb_purchase_order_detail.purchase_order_id')
      ->where("tb_purchase_requisition_detail.po_amount", "=", 0)
      ->get();
    return response()->json($table_purchase_requisition_detail);
  }

  public function edit_supplier(Request $request)
  {
    //ใช้ตอน กำหนดเจ้าหนี้ใบเสนอซื้อ
    $table_purchase_requisition_detail = RequisitionDetailModel::join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
      ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
      ->leftJoin('tb_supplier', 'tb_purchase_requisition_detail.supplier_id', '=', 'tb_supplier.supplier_id')
      // ->where("tb_purchase_requisition_detail.approved_amount", ">", 0)
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
