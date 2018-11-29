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

    public function updateByIds(Request $request)
    {
      $order_detail_id_list = $request->input('order_detail_id');
      //$amount_list = $request->input('amount');
      //$approve_amount_list = $request->input('approve_amount');
      $action = $request->input('action',"1");

      /*print_r($order_detail_id_list);
      echo "b";
            print_r($amount_list);
            echo "d";
                  print_r($approve_amount_list);
                  echo "e";
                        print_r($action);*/
      OrderDetailModel::update_order_detail_status_id_by_ids($action, $order_detail_id_list);
      /*//IF PARTIAL APPROVE
      for($i=0; $i<count($order_detail_id_list); $i++){
        //CHECK IF APPROVE < amount
          //insert
          OrderDetailModel::insert_by_id($id,$new_amount);
          //update

      }*/
      return redirect()->back();
    }

    public function getOrderDetails(Request $request){

      $order_detail_status_id = $request->input("order_detail_status_id",3);
      $m_date = $request->input("m_date","");
      $date_begin =  $request->input("date_begin","");
      $date_end = $request->input("date_end","");
      echo is_null($m_date);

      $table_order_detail = [];
      if($m_date !== "" && $m_date != null){
        //echo "mdate";
        //echo $m_date;
        $table_order_detail = OrderDetailModel::select_search($order_detail_status_id,$m_date);


      }else if($date_begin !== "" && $date_begin != null){
        //echo "begin";
        $table_order_detail = OrderDetailModel::select_search($order_detail_status_id,$date_begin,$date_end);

      }

      return response()->json($table_order_detail);
    }
}
