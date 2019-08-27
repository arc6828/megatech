<?php

namespace App\Http\Controllers\Purchase\unused;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase\PurchaseRequisitionModel;
use App\Purchase\PurchaseRequisitionDetailModel;
use App\ProductModel;

class PurchaseRequisitionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($purchase_requisition_id)
    {
        //QUATATION DETAIL
        $table_purchase_requisition_detail = PurchaseRequisitionDetailModel::select_by_purchase_requisition_id($purchase_requisition_id);
        $data = [
            'table_purchase_requisition_detail' => $table_purchase_requisition_detail,
            'purchase_requisition_id' => $purchase_requisition_id,
        ];
        return view('purchase/purchase_requisition_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $purchase_requisition_id)
    {
        $q = $request->input('q');
        $table_purchase_requisition = PurchaseRequisitionModel::select_by_id($purchase_requisition_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_purchase_requisition' => $table_purchase_requisition,
            'purchase_requisition_id' => $purchase_requisition_id,
            'q' => $q,
        ];
        return view('purchase/purchase_requisition_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$purchase_requisition_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "purchase_requisition_id" => $purchase_requisition_id,
        ];
        PurchaseRequisitionDetailModel::insert($input);
        return redirect("purchase/purchase_requisition/{$purchase_requisition_id}/edit#table");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($purchase_requisition_id, $id)
    {
        $table_purchase_requisition_detail = PurchaseRequisitionDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_purchase_requisition_detail' => $table_purchase_requisition_detail,
            'purchase_requisition_id' => $purchase_requisition_id,
        ];
        return view('purchase/purchase_requisition_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase_requisition_id, $id)
    {
		$table_purchase_requisition_detail = PurchaseRequisitionDetailModel::select_by_id($id);
        $data = [
            'table_purchase_requisition_detail' => $table_purchase_requisition_detail,
            'purchase_requisition_id' => $purchase_requisition_id,
        ];
        return view('purchase/purchase_requisition_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchase_requisition_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        PurchaseRequisitionDetailModel::update_by_id($input,$id);
        return redirect("purchase/purchase_requisition/{$purchase_requisition_id}/edit#table");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchase_requisition_id, $id)
    {
        PurchaseRequisitionDetailModel::delete_by_id($id);
        return redirect("purchase/purchase_requisition/{$purchase_requisition_id}/edit#table");
    }
}
