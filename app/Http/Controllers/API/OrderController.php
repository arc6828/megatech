<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sales\OrderDetailModel;
use App\Sales\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $user_id = $request->input("user_id", 0);
        if ($user_id > 0) {
            $table_order = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
                ->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
                ->join('users', 'tb_order.staff_id', '=', 'users.id')
                ->where('tb_order.user_id', '=', Auth::user()->id)
                ->get();
        }
        return response()->json($table_order);
    }

    public function validate_po(Request $request)
    {
        //$order_detail_status_id = $request->input("order_detail_status_id",3);
        
        $customer_id = $request->input("customer_id");
        $external_reference_id = $request->input("external_reference_id");

        $table_order = OrderModel::where('customer_id', $customer_id)
            ->where('external_reference_id', $external_reference_id); //select_by_po

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
        $table_order = OrderModel::join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
            ->join('users', 'users.id', '=', 'tb_order.staff_id')
            ->where('tb_order.order_id', '=', $id)
            ->orWhere('tb_order.order_code', '=', $id)
            ->select(DB::raw('users.*,tb_customer.*, tb_order.*'))
            ->get();

        //echo $id . "hello";
        if (count($table_order) > 0) {
            $id = $table_order[0]->order_id;
        }
        $table_order_detail = OrderDetailModel::join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
            ->where('order_id', '=', $id)
            ->where('order_detail_status_id', 1)
            ->get();

        $data = [
            "table_order" => $table_order,
            "table_order_detail" => $table_order_detail, // 1 MEANS APPROVED
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
