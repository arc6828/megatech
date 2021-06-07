<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Sales\QuotationDetailModel;
use Illuminate\Http\Request;

class QuotationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table_product = QuotationDetailModel::select_all();
        return response()->json($table_product);
    }

    public function index_by_customer($customer_id)
    {
        $table_product = QuotationDetailModel::join('tb_product', 'tb_quotation_detail.product_id', '=', 'tb_product.product_id')
            ->join('tb_quotation', 'tb_quotation_detail.quotation_id', '=', 'tb_quotation.quotation_id')
            ->where('customer_id', '=', $customer_id)
            ->get();

        return response()->json($table_product);
    }

    public function index_by_user($customer_id, $user_id)
    {
        $table_product = QuotationDetailModel::join('tb_product', 'tb_quotation_detail.product_id', '=', 'tb_product.product_id')
            ->join('tb_quotation', 'tb_quotation_detail.quotation_id', '=', 'tb_quotation.quotation_id')
            ->where('user_id', '=', $user_id)
            ->where('customer_id', '=', $customer_id)
            ->where('tb_quotation.sales_status_id', '!=', '-1') //NOT VOID
            ->where('tb_quotation.sales_status_id', '!=', '0') //NOT DRAFT
            ->where('tb_quotation.sales_status_id', '!=', '5') //NOT COMPLETED
            ->get();
        return response()->json($table_product);
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
