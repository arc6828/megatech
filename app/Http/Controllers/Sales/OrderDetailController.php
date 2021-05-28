<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Sales\OrderDetailModel;
use App\Sales\OrderDetailStatusModel;
use App\Sales\OrderModel;
use App\Sales\PickingModel;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        $filter = (object) [
            "order_detail_status_id" => $request->input("order_detail_status_id", 3),
            "m_date" => $request->input("m_date", "all"),
            "date_begin" => $request->input("date_begin", ""),
            "date_end" => $request->input("date_end", ""),
            "order_id" => $request->input("order_id", ""),
            "remark" => $request->input("remark", ""),
        ];
        $table_order_detail_status = OrderDetailStatusModel::all();

        $data = [
            'table_order_detail_status' => $table_order_detail_status,
            'filter' => $filter,
        ];
        return view('sales/order_detail/index', $data);
    }

    public function approve(Request $request)
    {
        $order_detail_ids = $request->input('order_detail_ids');
        $approve_amounts = $request->input('approve_amounts');
        $action = $request->input('action', "1");

        if ($action == 1) {
            $picking = PickingModel::create([
                'picking_code' => $this->getNewCode(),
                "remark" => $request->input('remark', ""),
            ]);
        }
        $order = OrderDetailModel::where('order_detail_id', $order_detail_ids)->first();

        OrderDetailModel::where('before_approved_amount', $order->before_approved_amount)->first()->decrement('before_approved_amount', $approve_amounts[0]);
        OrderDetailModel::where('approved_amount', $order->approved_amount)->first()->increment('approved_amount', $approve_amounts[0]);

        foreach ($order as $item) {
            $input_detail = [
                "picking_code" => $picking->picking_code,
                "order_detail_status_id" => $action,
            ];

            //4. Update status_id_detail
            OrderDetailModel::where('order_detail_id', $order_detail_ids)->update($input_detail);

        }
        //CHANGE STATUS ORDER
        $order = OrderDetailModel::where('order_detail_id', $order_detail_ids)->first();
        $order_id = $order->order_id;

        $count = OrderDetailModel::where('order_detail_status_id', 3)
            ->where('order_id', $order_id)
            ->count();
        // print_r(json_encode($count));
        // exit();

        if ($count == 0) {
            //NO ONE LEFT : 8 => อนุมัติครบ
            OrderModel::where('order_id', $order->order_id)->update(["sales_status_id" => 8]);
        }
        return redirect()->back();
    }

    public function getNewCode()
    {
        $number = PickingModel::select_count_by_current_month();
        $count = $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $order_code = "PC{$year}{$month}-{$number}";
        return $order_code;
    }
}
