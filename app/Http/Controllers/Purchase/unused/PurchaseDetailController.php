<?php

namespace App\Http\Controllers\Purchase\unused;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase\PurchaseModel;
use App\Purchase\PurchaseDetailModel;
use App\ProductModel;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($purchase_receive_id)
    {
        //QUATATION DETAIL
        $table_purchase_receive_detail = PurchaseDetailModel::select_by_purchase_receive_id($purchase_receive_id);
        $data = [
            'table_purchase_receive_detail' => $table_purchase_receive_detail,
            'purchase_receive_id' => $purchase_receive_id,
        ];
        return view('purchase/purchase_receive_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $purchase_receive_id)
    {
        $q = $request->input('q');
        $table_purchase_receive = PurchaseModel::select_by_id($purchase_receive_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_purchase_receive' => $table_purchase_receive,
            'purchase_receive_id' => $purchase_receive_id,
            'q' => $q,
        ];
        return view('purchase/purchase_receive_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$purchase_receive_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "purchase_receive_id" => $purchase_receive_id,
        ];
        PurchaseDetailModel::insert($input);
        return redirect("purchase/purchase_receive/{$purchase_receive_id}/edit#table");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($purchase_receive_id, $id)
    {
        $table_purchase_receive_detail = PurchaseDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_purchase_receive_detail' => $table_purchase_receive_detail,
            'purchase_receive_id' => $purchase_receive_id,
        ];
        return view('purchase/purchase_receive_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase_receive_id, $id)
    {
		$table_purchase_receive_detail = PurchaseDetailModel::select_by_id($id);
        $data = [
            'table_purchase_receive_detail' => $table_purchase_receive_detail,
            'purchase_receive_id' => $purchase_receive_id,
        ];
        return view('purchase/purchase_receive_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchase_receive_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        PurchaseDetailModel::update_by_id($input,$id);
        return redirect("purchase/purchase_receive/{$purchase_receive_id}/edit#table");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchase_receive_id, $id)
    {
        PurchaseDetailModel::delete_by_id($id);
        return redirect("purchase/purchase_receive/{$purchase_receive_id}/edit#table");
    }
}
