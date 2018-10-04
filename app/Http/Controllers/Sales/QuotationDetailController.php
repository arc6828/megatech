<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuotationModel;
use App\QuotationDetailModel;
use App\ProductModel;

class QuotationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($quotation_id)
    {
        //QUATATION DETAIL
        $table_quotation_detail = QuotationDetailModel::select_by_quotation_id($quotation_id);
        $data = [
            'table_quotation_detail' => $table_quotation_detail,
            'quotation_id' => $quotation_id,
        ];
        return view('sales/quotation_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $quotation_id)
    {
        $q = $request->input('q');
        $table_quotation = QuotationModel::select_by_id($quotation_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_quotation' => $table_quotation,
            'quotation_id' => $quotation_id,
            'q' => $q,
        ];
        return view('sales/quotation_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$quotation_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "quotation_id" => $quotation_id,
        ];
        QuotationDetailModel::insert($input);
        return redirect("sales/quotation/{$quotation_id}/quotation_detail");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quotation_id, $id)
    {
        $table_quotation_detail = QuotationDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_quotation_detail' => $table_quotation_detail,
            'quotation_id' => $quotation_id,
        ];
        return view('sales/quotation_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quotation_id, $id)
    {
		$table_quotation_detail = QuotationDetailModel::select_by_id($id);
        $data = [
            'table_quotation_detail' => $table_quotation_detail,
            'quotation_id' => $quotation_id,
        ];
        return view('sales/quotation_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quotation_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        QuotationDetailModel::update_by_id($input,$id);
        return redirect("sales/quotation/{$quotation_id}/quotation_detail");
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
