<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\ProductDetail;
use App\Brand;


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
        $data = [
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
        $brands = Brand::all();
        return view('product/create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        ProductModel::create($requestData);
        return redirect('product');
    }

    public function store_detail(Request $request, $product){
        //CREATE RETURN INVOICE DETAIL
        $details = [];
        $products = $request->input('product_ids');
        $amounts = $request->input('amounts');
        //$discount_prices = $request->input('discount_prices');
        //$totals = $request->input('totals');
        if (is_array($products)){
            for($i=0; $i<count($products); $i++){
                $details[] = [
                    "detail_product_id" => $products[$i],
                    "amount" => $amounts[$i],
                    "final_product_id" => $product->product_id,              
                ];
            }
            //DELETE ALL BEFORE INSERT
            ProductDetail::where('final_product_id',$product->product_id)->delete();
            //INSERT
            ProductDetail::insert($details);
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brands = Brand::all();
        $table_product = ProductModel::findOrFail($id);
        $product = ProductModel::findOrFail($id);
        $mode = "show";
        return view('product/edit', compact('table_product','brands','product','mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::all();
        $table_product = ProductModel::findOrFail($id);
        $product = ProductModel::findOrFail($id);
        $mode = "edit";
        return view('product/edit', compact('table_product','brands','product','mode'));
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
        /*
        $input = [
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'brand' => $request->input('product_brand'),
            'product_detail' => $request->input('product_detail'),
            'product_unit' => $request->input('product_unit')
        ];
        ProductModel::update_by_id($input,$id);
        */

        $requestData = $request->all();
        unset($requestData["_method"]);
        unset($requestData["_token"]);
        //$requestData['product_id'] =  $requestData["id"];
        //$requestData['id'] = null;

        $product = ProductModel::findOrFail($id);
        $product->update($requestData);
        // ProductModel::update_by_id($requestData,$id);
        
        //$product2->update($requestData);

        $this->store_detail($request, $product);

        return redirect("product/{$id}");


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
