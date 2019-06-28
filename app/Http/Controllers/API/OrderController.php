<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderDetailStatusModel;
use App\Sales\OrderDetailModel;
use App\Sales\OrderModel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$order_detail_status_id = $request->input("order_detail_status_id",3);
      //$table_order = OrderModel::select_all();


      $user_id = $request->input("user_id",0);
      if($user_id > 0)
      {
        $table_order = OrderModel::select_all_by_user_id($user_id);
      }
      return response()->json($table_order);
    }

    public function validate_po(Request $request)
    {
      //$order_detail_status_id = $request->input("order_detail_status_id",3);
      $customer_id = $request->input("customer_id");
      $external_reference_id = $request->input("external_reference_id");
      $table_order = OrderModel::select_by_po($customer_id,$external_reference_id);
      return response()->json($table_order);
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
      $table_order = OrderModel::select_by_id($id);
        //echo $id . "hello";
      if(count($table_order) > 0){
        $id = $table_order[0]->order_id;
      }


      $data = [
        "table_order" => OrderModel::select_by_id($id),
        "table_order_detail" => OrderDetailModel::select_by_order_id_by_status_id($id, 1), // 1 MEANS APPROVED
      ];
      return response()->json($data);
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
