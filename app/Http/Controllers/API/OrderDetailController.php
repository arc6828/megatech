<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sales\OrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ใช้ตอนเบิกของ
        $order_detail_status_id = $request->input("order_detail_status_id", 3);
        
        $table_order_detail = OrderDetailModel::join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
            ->join('tb_order', 'tb_order.order_id', '=', 'tb_order_detail.order_id')
            ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_order_detail_status', 'tb_order_detail.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
            ->where("tb_order_detail.order_detail_status_id", "=", $order_detail_status_id)
            ->where("tb_order_detail.amount", ">", 0)
            ->select(DB::raw('*,DATE(datetime) as date'))
            ->get();

        return response()->json($table_order_detail);
        // $m_date = $request->input("m_date", "");
        // $date_begin = $request->input("date_begin", "");
        // $date_end = $request->input("date_end", "");
        //echo is_null($m_date);
        // $table_order_detail = [];

        // ใช้ในหน้า order_detail
        // if ($m_date !== "" && $m_date != null) {
        //     //echo "mdate";
        //     //echo $m_date;
        //     if ($m_date === "all") {

        //     } else {
        //         $table_order_detail = OrderDetailModel::select_search($order_detail_status_id, $m_date);
        //     }
        // } else if ($date_begin !== "" && $date_begin != null) {
        //     //echo "begin";
        //     $table_order_detail = OrderDetailModel::select_search($order_detail_status_id, $date_begin, $date_end);
        // }

    }

    // public function index2(Request $request)
    // {
    //     $order_detail_status_id = $request->input("order_detail_status_id", 3);
    //     $table_order_detail = OrderDetailModel::select_search2($order_detail_status_id);

    //     return response()->json($table_order_detail);
    // }

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

    public function history_sell_price($customer_id, $product_id)
    {
        // quotation เรียกใช้งาน จังหวะ ตอนลูกค้าเปิดใบเสนอราคา
        $order_detail = OrderDetailModel::join('tb_order', 'tb_order_detail.order_id', '=', 'tb_order.order_id')

            ->where('product_id', $product_id)
            ->where('customer_id', $customer_id)
            ->orderBy('datetime', 'desc')->first();

        return response()->json($order_detail);
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
