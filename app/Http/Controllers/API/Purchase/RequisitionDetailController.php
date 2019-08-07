<?php

namespace App\Http\Controllers\API\Purchase;

use Illuminate\Http\Request;
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
      $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id",3);
      $m_date = $request->input("m_date","");
      $date_begin =  $request->input("date_begin","");
      $date_end = $request->input("date_end","");
      //echo is_null($m_date);
      $table_purchase_requisition_detail = [];
      if($m_date !== "" && $m_date != null){
        //echo "mdate";
        //echo $m_date;
        $table_purchase_requisition_detail = RequisitionDetailModel::select_search($purchase_requisition_detail_status_id,$m_date);
      }else if($date_begin !== "" && $date_begin != null){
        //echo "begin";
        $table_purchase_requisition_detail = RequisitionDetailModel::select_search($purchase_requisition_detail_status_id,$date_begin,$date_end);
      }
      return response()->json($table_purchase_requisition_detail);
    }

    public function index2(Request $request)
    {
      //FOR PO STEP - DEFAULT IS 4 => DEFINED SUPPLIER
      $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id",4);
      $table_purchase_requisition_detail = RequisitionDetailModel::select_search2($purchase_requisition_detail_status_id);
      return response()->json($table_purchase_requisition_detail);
    }

    public function index_by_supplier(Request $request,$supplier_id)
    {
      //FOR PO STEP - DEFAULT IS 4 => DEFINED SUPPLIER
      //FOR RECEIVE STEP - 5 => RECEIVE FROM SUPPLIER
      $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id",4);
      $table_purchase_requisition_detail = RequisitionDetailModel::select_search_by_supplier_id($purchase_requisition_detail_status_id, $supplier_id);
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
