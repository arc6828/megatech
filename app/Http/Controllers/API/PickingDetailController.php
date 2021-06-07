<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sales\PickingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PickingDetailController extends Controller
{
  /**
   * Display a listing of the resource pickking_detail display.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $order_detail_status_id = $request->input("order_detail_status_id", 3);

    $table_pickking_detail = PickingDetail::join('tb_product', 'tb_sales_picking_details.product_id', '=', 'tb_product.product_id')
      ->join('tb_order', 'tb_sales_picking_details.order_id', '=', 'tb_order.order_id')
      ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_order_detail_status', 'tb_sales_picking_details.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
      ->where("tb_sales_picking_details.order_detail_status_id", "=", $order_detail_status_id)
      ->where("tb_sales_picking_details.amount", ">", 0)
      ->where("tb_sales_picking_details.before_approved_amount", ">", 0)
      ->select(DB::raw('*,DATE(datetime) as date'))
      ->get();

    return response()->json($table_pickking_detail);
  }
  // public function history_sell_price($customer_id, $product_id)
  // {
  //     // quotation เรียกใช้งาน จังหวะ ตอนลูกค้าเปิดใบเสนอราคา
  //     $pickking_detail = PickingDetail::join('tb_order', 'tb_sales_picking_details.order_id', '=', 'tb_order.order_id')

  //         ->where('product_id', $product_id)
  //         ->where('customer_id', $customer_id)
  //         ->orderBy('datetime', 'desc')->first();

  //     return response()->json($pickking_detail);
  // }

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
}
