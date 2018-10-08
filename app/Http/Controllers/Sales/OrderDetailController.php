<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sales\OrderModel;
use App\Sales\OrderDetailModel;
use App\ProductModel;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order_id)
    {
        //QUATATION DETAIL
        $table_order_detail = OrderDetailModel::select_by_order_id($order_id);
        $data = [
            'table_order_detail' => $table_order_detail,
            'order_id' => $order_id,
        ];
        return view('sales/order_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $order_id)
    {
        $q = $request->input('q');
        $table_order = OrderModel::select_by_id($order_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_order' => $table_order,
            'order_id' => $order_id,
            'q' => $q,
        ];
        return view('sales/order_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$order_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "order_id" => $order_id,
        ];
        OrderDetailModel::insert($input);
        return redirect("sales/order/{$order_id}/order_detail");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id, $id)
    {
        $table_order_detail = OrderDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_order_detail' => $table_order_detail,
            'order_id' => $order_id,
        ];
        return view('sales/order_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order_id, $id)
    {
		$table_order_detail = OrderDetailModel::select_by_id($id);
        $data = [
            'table_order_detail' => $table_order_detail,
            'order_id' => $order_id,
        ];
        return view('sales/order_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        OrderDetailModel::update_by_id($input,$id);
        return redirect("sales/order/{$order_id}/order_detail");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id, $id)
    {
        OrderDetailModel::delete_by_id($id);
        return redirect("sales/order/{$order_id}/order_detail");
    }
}
