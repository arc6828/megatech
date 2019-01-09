<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderDetailModel;
use App\Sales\OrderDetailStatusModel;

class OrderDetailController extends Controller
{
  public function index(Request $request)
  {
    $filter = (object)[
      "order_detail_status_id" => $request->input("order_detail_status_id",3),
      "m_date" => $request->input("m_date", "".date('Y')."-".date('m')."-"."01"),
      "date_begin" =>  $request->input("date_begin",""),
      "date_end" => $request->input("date_end",""),
    ];
    $data = [
      'table_order_detail_status' => OrderDetailStatusModel::select_all(),
      'filter' => $filter,
    ];
    return view('sales/order_detail/index',$data);
  }

  public function approve(Request $request)
  {
    $order_detail_ids = $request->input('order_detail_ids');
    $selected_order_detail_ids = $request->input('selected_order_detail_ids');
    $amounts = $request->input('amounts');
    $approve_amounts = $request->input('approve_amounts');
    $action = $request->input('action',"1");

    //IF PARTIAL APPROVE
    for($i=0; $i<count($order_detail_ids); $i++){
      //CHECK IF IS CHECKED LIST
      if(in_array($order_detail_ids[$i],$selected_order_detail_ids)){
        //CHECK IF APPROVE < amount
        if($approve_amounts[$i] < $amounts[$i]){
          //insert new order detail
          $new_amount = $amounts[$i] - $approve_amounts[$i];
          OrderDetailModel::duplicate_by_id($new_amount, $order_detail_ids[$i]);
          //update by approve amount
          OrderDetailModel::update_by_id(["amount"=>$approve_amounts[$i]] , $order_detail_ids[$i]);
        }
      }
    }
    OrderDetailModel::update_order_detail_status_id_by_ids($action, $selected_order_detail_ids);
    return redirect()->back();
  }
}
