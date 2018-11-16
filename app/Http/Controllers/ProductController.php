<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$q = $request->input('q');
        $table_product = ProductModel::select_by_keyword($q);
        $data = [
	        'table_product' => $table_product,
        	'q' => $q
        ];
        return view('product/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table_product = ProductModel::select_all();
        $data = [
            'table_product' => $table_product
        ];
        return view('product/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'brand' => $request->input('product_brand'),
            'product_detail' => $request->input('product_detail'),
            'product_unit' => $request->input('product_unit')
        ];

        ProductModel::insert($input);
        return redirect('product');
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
        $table_product = ProductModel::select_by_id($id);
        $data = [
            'table_product' => $table_product
        ];
        return view('product/edit',$data);
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
        $input = [
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'brand' => $request->input('product_brand'),
            'product_detail' => $request->input('product_detail'),
            'product_unit' => $request->input('product_unit')
        ];
        ProductModel::update_by_id($input,$id);
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductModel::delete_by_id($id);
        return redirect('product');
    }
}
