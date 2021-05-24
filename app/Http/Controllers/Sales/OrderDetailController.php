<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderDetailModel;
use App\Sales\OrderModel;
use App\Sales\OrderDetailStatusModel;
use App\Sales\PickingModel;

class OrderDetailController extends Controller
{
  public function index(Request $request)
  {
    $filter = (object)[
      "order_detail_status_id" => $request->input("order_detail_status_id",3),
      //"m_date" => $request->input("m_date", "".date('Y')."-".date('m')."-"."01"),
      "m_date" => $request->input("m_date", "all"),
      "date_begin" =>  $request->input("date_begin",""),
      "date_end" => $request->input("date_end",""),
      "order_id" => $request->input("order_id",""),
      "remark" => $request->input("remark",""),
      //"company_name" => $request->input("company_name",""),
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
    $action = $request->input('action',"1"); // index.blade.php

    //CREATE PICKING ID
    $picking_code = "";
    if($action == 1){ //ONLY APPROVE WILL USE PICKING
      $picking_code = $this->getNewCode();
      $input = [
        'picking_code' => $picking_code,
        "remark" => $request->input('remark',""),
      ];
      PickingModel::insert($input);
    }

    //IF PARTIAL APPROVE
    for($i=0; $i<count($order_detail_ids); $i++){
      //CHECK IF IS CHECKED LIST
      if(in_array($order_detail_ids[$i],$selected_order_detail_ids)){
        //CHECK IF APPROVE < amount
        if($approve_amounts[$i] < $amounts[$i]){
          //insert new order detail
          $new_amount = $amounts[$i] - $approve_amounts[$i];
          //DUPLICATE NEW ITEM FOR REMAINING - DON"T CARE
          OrderDetailModel::duplicate_by_id($new_amount, $order_detail_ids[$i]);
          //update by approve amount
          $input_detail = [
            "amount"=>$approve_amounts[$i],
            "picking_code"=> $picking_code,
            "order_detail_status_id" => $action,
          ];
          OrderDetailModel::update_by_id($input_detail , $order_detail_ids[$i]);
        }else if ($approve_amounts[$i] == $amounts[$i]){
          $input_detail = [
            //"amount"=>$approve_amounts[$i],
            "picking_code"=> $picking_code,
            "order_detail_status_id" => $action,
          ];
          OrderDetailModel::update_by_id($input_detail , $order_detail_ids[$i]);
        }
      }
      //IF ALL DETAIL APPROVE change Order sale_status_id = 8 which means all approved
      //CHECK if ALL RECEIVED, UPDATE STATUS PO : 4 => ปิดการซื้อเรียบร้อย
      //$purchase_order_code = $request->input('internal_reference_doc');
      //echo $purchase_order_code;

      //CHANGE STATUS ORDER
      $order = OrderDetailModel::where('order_detail_id', $order_detail_ids[$i])->first();
      $order_id = $order->order_id;
      $count = OrderDetailModel::countWaitApprove($order_id);
      if($count == 0){
          //NO ONE LEFT : 8 => อนุมัติครบ
          OrderModel:: update_by_id(
            ["sales_status_id"=>"8"],
            $order_id
          );
      }
    }




    //OrderDetailModel::update_order_detail_status_id_by_ids($action, $selected_order_detail_ids);
    return redirect()->back();
  }

  public function getNewCode(){
      $number = PickingModel::select_count_by_current_month();
      $count =  $number + 1;
      //$year = (date("Y") + 543) % 100;
      $year = date("y");
      $month = date("m");
      $number = sprintf('%05d', $count);
      $order_code = "PC{$year}{$month}-{$number}";
      return $order_code;
  }
}
