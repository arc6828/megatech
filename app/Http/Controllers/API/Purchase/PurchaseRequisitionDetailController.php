<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use App\Sales\OrderDetailStatusModel;
//use App\Sales\OrderDetailModel;

use App\Purchase\PurchaseRequisitionDetailModel;
use App\Purchase\PurchaseRequisitionDetailStatusModel;


class PurchaseRequisitionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $purchase_requisition_detail_status_id = $request->input("purchase_requisition_detail_status_id",3);
      $m_date = $request->input("m_date","");
      $date_begin =  $request->input("date_begin","");
      $date_end = $request->input("date_end","");
      //echo is_null($m_date);
      $table_purchase_requisition_detail = [];
      if($m_date !== "" && $m_date != null){
        //echo "mdate";
        //echo $m_date;
        $table_purchase_requisition_detail = PurchaseRequisitionDetailModel::select_search($purchase_requisition_detail_status_id,$m_date);
      }else if($date_begin !== "" && $date_begin != null){
        //echo "begin";
        $table_purchase_requisition_detail = PurchaseRequisitionDetailModel::select_search($purchase_requisition_detail_status_id,$date_begin,$date_end);
      }
      return response()->json($table_purchase_requisition_detail);
    }

    public function index_by_customer(Request $request,$customer_id)
    {
      //$customer_id = $request->input("customer_id");
      $table_purchase_requisition_detail = PurchaseRequisitionDetailModel::join('tb_purchase_requisition','tb_purchase_requisition_detail.purchase_requisition_id','=','tb_purchase_requisition.purchase_requisition_id')
        ->join('tb_product','tb_purchase_requisition_detail.product_id','=','tb_product.product_id')

        ->where("customer_id",$customer_id)->get();

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
