<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Sales\OrderDetailModel;
use App\Sales\OrderDetailStatusModel;
use App\Sales\OrderModel;
use App\Sales\PickingDetail;
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
        //ดึงข้อมูล picking_detail จาก frontend
        $order_detail_ids = $request->input('order_detail_ids');
        $approve_amounts = $request->input('approve_amounts');
        $action = $request->input('action', "1");

        //ดึงข้อมูลจาก picking_detail
        $picking_detail = PickingDetail::where('sales_picking_detail_id', $order_detail_ids)->first();
        $order_id = $picking_detail->order_id;

        //Gen code picking_code / create picking
        if ($action == 1) {
            $picking = PickingModel::create([
                'picking_code' => $this->getNewCode(),
                'order_code' => $picking_detail->order_code,
                "remark" => $request->input('remark', ""),
            ]);
        }

        //decrement before_approved_amount (update)
        PickingDetail::where('before_approved_amount', $picking_detail->before_approved_amount)->first()->decrement('before_approved_amount', $approve_amounts[0]);
        //incrementapproved_amount (update)
        PickingDetail::where('approved_amount', $picking_detail->approved_amount)->first()->increment('approved_amount', $approve_amounts[0]);

        foreach ($picking_detail as $item) {
            //insert picking_code / order_detail_status_id = อนุมัติ (1)
            $input_detail = [
                "picking_code" => $picking->picking_code,
                "order_detail_status_id" => $action,
            ];

            //Update picking_detail / order_detail
            PickingDetail::where('sales_picking_detail_id', $order_detail_ids)->update($input_detail);
            OrderDetailModel::where('order_detail_status_id', 3)->update($input_detail);

        }

        //CHANGE STATUS ORDER  Update  order sales_status = 8
        $count = PickingDetail::where('order_detail_status_id', 3)
            ->where('order_id', $order_id)
            ->count();

        if ($count == 0) {
            //NO ONE LEFT : 8 => อนุมัติครบ
            OrderModel::where('order_id', $order_id)->update(["sales_status_id" => 8]);
        }
        return redirect()->back();
    }

    public function getNewCode()
    {
        $number = PickingModel::whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
        $count = $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $order_code = "PC{$year}{$month}-{$number}";
        return $order_code;
    }
}
