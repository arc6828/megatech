<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $q = $request->input("q","");
        $table_product = ProductModel::where('product_name', 'like' , "%{$q}%" )
            ->orWhere('item_code', 'like' , "%{$q}%" )
            ->orWhere('product_code', 'like' , "%{$q}%" )
            ->orderBy('amount_in_stock','desc')
            ->limit(500)
            ->get(); 
        return response()->json($table_product);
    }

    public function index_short(Request $request)
    { //WHEN TO USED?
      $q = $request->input("q","");
      $table_product = ProductModel::select_by_keyword($q);
      //$q = "";
      //$table_product = ProductModel::select("product_id,product_code,product_name,brand,promotion_price,max_discount_percent,amount_in_stock,product_unit,pending_in,pending_out,normal_price,BARCODE,quantity")->get();
      //$table_product = ProductModel::select("product_id,product_code,product_name,brand,amount_in_stock,pending_in,pending_out,normal_price,BARCODE,quantity")->get();

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
