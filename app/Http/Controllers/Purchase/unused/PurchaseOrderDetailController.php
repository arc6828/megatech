<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase\PurchaseOrderModel;
use App\Purchase\PurchaseOrderDetailModel;
use App\ProductModel;

class PurchaseOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($purchase_order_id)
    {
        //QUATATION DETAIL
        $table_purchase_order_detail = PurchaseOrderDetailModel::select_by_purchase_order_id($purchase_order_id);
        $data = [
            'table_purchase_order_detail' => $table_purchase_order_detail,
            'purchase_order_id' => $purchase_order_id,
        ];
        return view('purchase/purchase_order_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $purchase_order_id)
    {
        $q = $request->input('q');
        $table_purchase_order = PurchaseOrderModel::select_by_id($purchase_order_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_purchase_order' => $table_purchase_order,
            'purchase_order_id' => $purchase_order_id,
            'q' => $q,
        ];
        return view('purchase/purchase_order_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$purchase_order_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "purchase_order_id" => $purchase_order_id,
        ];
        PurchaseOrderDetailModel::insert($input);
        return redirect("purchase/purchase_order/{$purchase_order_id}/edit#table");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($purchase_order_id, $id)
    {
        $table_purchase_order_detail = PurchaseOrderDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_purchase_order_detail' => $table_purchase_order_detail,
            'purchase_order_id' => $purchase_order_id,
        ];
        return view('purchase/purchase_order_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase_order_id, $id)
    {
		$table_purchase_order_detail = PurchaseOrderDetailModel::select_by_id($id);
        $data = [
            'table_purchase_order_detail' => $table_purchase_order_detail,
            'purchase_order_id' => $purchase_order_id,
        ];
        return view('purchase/purchase_order_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchase_order_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        PurchaseOrderDetailModel::update_by_id($input,$id);
        return redirect("purchase/purchase_order/{$purchase_order_id}/edit#table");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchase_order_id, $id)
    {
        PurchaseOrderDetailModel::delete_by_id($id);
        return redirect("purchase/purchase_order/{$purchase_order_id}/edit#table");
    }
}
