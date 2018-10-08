<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sales\RequisitionModel;
use App\Sales\RequisitionDetailModel;
use App\ProductModel;

class RequisitionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($requisition_id)
    {
        //QUATATION DETAIL
        $table_requisition_detail = RequisitionDetailModel::select_by_requisition_id($requisition_id);
        $data = [
            'table_requisition_detail' => $table_requisition_detail,
            'requisition_id' => $requisition_id,
        ];
        return view('sales/requisition_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $requisition_id)
    {
        $q = $request->input('q');
        $table_requisition = RequisitionModel::select_by_id($requisition_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_requisition' => $table_requisition,
            'requisition_id' => $requisition_id,
            'q' => $q,
        ];
        return view('sales/requisition_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$requisition_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "requisition_id" => $requisition_id,
        ];
        RequisitionDetailModel::insert($input);
        return redirect("sales/requisition/{$requisition_id}/requisition_detail");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($requisition_id, $id)
    {
        $table_requisition_detail = RequisitionDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_requisition_detail' => $table_requisition_detail,
            'requisition_id' => $requisition_id,
        ];
        return view('sales/requisition_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($requisition_id, $id)
    {
		$table_requisition_detail = RequisitionDetailModel::select_by_id($id);
        $data = [
            'table_requisition_detail' => $table_requisition_detail,
            'requisition_id' => $requisition_id,
        ];
        return view('sales/requisition_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $requisition_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        RequisitionDetailModel::update_by_id($input,$id);
        return redirect("sales/requisition/{$requisition_id}/requisition_detail");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($requisition_id, $id)
    {
        RequisitionDetailModel::delete_by_id($id);
        return redirect("sales/requisition/{$requisition_id}/requisition_detail");
    }
}
