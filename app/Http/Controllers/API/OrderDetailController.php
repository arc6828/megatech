<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderDetailStatusModel;
use App\Sales\OrderDetailModel;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $order_detail_status_id = $request->input("order_detail_status_id",3);
      $m_date = $request->input("m_date","");
      $date_begin =  $request->input("date_begin","");
      $date_end = $request->input("date_end","");
      //echo is_null($m_date);
      $table_order_detail = [];
      if($m_date !== "" && $m_date != null){
        //echo "mdate";
        //echo $m_date;
        if($m_date === "all"){
          $table_order_detail = OrderDetailModel::select_search2($order_detail_status_id);
        }else{
          $table_order_detail = OrderDetailModel::select_search($order_detail_status_id,$m_date);
        }
      }else if($date_begin !== "" && $date_begin != null){
        //echo "begin";
        $table_order_detail = OrderDetailModel::select_search($order_detail_status_id,$date_begin,$date_end);
      }
      return response()->json($table_order_detail);
    }

    public function index2(Request $request)
    {
      $order_detail_status_id = $request->input("order_detail_status_id",3);
      $table_order_detail = OrderDetailModel::select_search2($order_detail_status_id);

      return response()->json($table_order_detail);
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
