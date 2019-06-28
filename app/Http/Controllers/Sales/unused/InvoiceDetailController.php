<?php

namespace App\Http\Controllers\Sales\unused;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sales\InvoiceModel;
use App\Sales\InvoiceDetailModel;
use App\ProductModel;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invoice_id)
    {
        //QUATATION DETAIL
        $table_invoice_detail = InvoiceDetailModel::select_by_invoice_id($invoice_id);
        $data = [
            'table_invoice_detail' => $table_invoice_detail,
            'invoice_id' => $invoice_id,
        ];
        return view('sales/invoice_detail/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $invoice_id)
    {
        $q = $request->input('q');
        $table_invoice = InvoiceModel::select_by_id($invoice_id);
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
            'table_product' => $table_product,
            'table_invoice' => $table_invoice,
            'invoice_id' => $invoice_id,
            'q' => $q,
        ];
        return view('sales/invoice_detail/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$invoice_id)
    {
        $input = [
            "product_id" => $request->input('product_id'),
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
            "invoice_id" => $invoice_id,
        ];
        InvoiceDetailModel::insert($input);
        return redirect("sales/invoice/{$invoice_id}/invoice_detail");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_id, $id)
    {
        $table_invoice_detail = InvoiceDetailModel::select_by_id($id);
        $data = [
            'table_product' => $table_product,
            'table_invoice_detail' => $table_invoice_detail,
            'invoice_id' => $invoice_id,
        ];
        return view('sales/invoice_detail/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice_id, $id)
    {
		$table_invoice_detail = InvoiceDetailModel::select_by_id($id);
        $data = [
            'table_invoice_detail' => $table_invoice_detail,
            'invoice_id' => $invoice_id,
        ];
        return view('sales/invoice_detail/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $invoice_id, $id)
    {
		$input = [
            "amount" => $request->input('amount'),
            "discount_price" => $request->input('discount_price',0),
        ];
        InvoiceDetailModel::update_by_id($input,$id);
        return redirect("sales/invoice/{$invoice_id}/invoice_detail");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice_id, $id)
    {
        InvoiceDetailModel::delete_by_id($id);
        return redirect("sales/invoice/{$invoice_id}/invoice_detail");
    }
}
