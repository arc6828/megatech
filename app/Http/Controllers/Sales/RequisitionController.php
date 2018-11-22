<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderDetailStatusModel;
use App\Sales\OrderDetailModel;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $table_order_detail_status = OrderDetailStatusModel::select_all();
      $filter = (object)[
        "order_detail_status_id" => $request->input("order_detail_status_id",3),
        "m_date" => $request->input("m_date", "".date('Y')."-".date('m')."-"."01"),
        "date_begin" =>  $request->input("date_begin",""),
        "date_end" => $request->input("date_end",""),
      ];
      $data = [
          'table_order_detail_status' => $table_order_detail_status,
          'filter' => $filter,
      ];
      return view('sales/requisition/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function getOrderDetails(Request $request){

      $order_detail_status_id = $request->input("order_detail_status_id",3);
      $m_date = $request->input("m_date","");
      $date_begin =  $request->input("date_begin","");
      $date_end = $request->input("date_end","");

      $table_order_detail = [];
      if($m_date === ""){
        echo "begin";
        $table_order_detail = OrderDetailModel::select_search($order_detail_status_id,$date_begin,$date_end);

      }else if($date_begin === ""){
        echo "mdate";
        echo $m_date;
        $table_order_detail = OrderDetailModel::select_search($order_detail_status_id,$m_date);
      }

      //return response()->json($table_order_detail);
    }
}
