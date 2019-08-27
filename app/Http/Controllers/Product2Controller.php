<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product2;
use Illuminate\Http\Request;

class Product2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $product2 = Product2::where('product_code', 'LIKE', "%$keyword%")
                ->orWhere('product_name', 'LIKE', "%$keyword%")
                ->orWhere('product_detail', 'LIKE', "%$keyword%")
                ->orWhere('brand', 'LIKE', "%$keyword%")
                ->orWhere('promotion_price', 'LIKE', "%$keyword%")
                ->orWhere('floor_price', 'LIKE', "%$keyword%")
                ->orWhere('max_discount_percent', 'LIKE', "%$keyword%")
                ->orWhere('amount_in_stock', 'LIKE', "%$keyword%")
                ->orWhere('product_unit', 'LIKE', "%$keyword%")
                ->orWhere('pending_in', 'LIKE', "%$keyword%")
                ->orWhere('pending_out', 'LIKE', "%$keyword%")
                ->orWhere('normal_price', 'LIKE', "%$keyword%")
                ->orWhere('BARCODE', 'LIKE', "%$keyword%")
                ->orWhere('purchase_price', 'LIKE', "%$keyword%")
                ->orWhere('purchase_ref', 'LIKE', "%$keyword%")
                ->orWhere('ISBN', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $product2 = Product2::latest()->paginate($perPage);
        }

        return view('product2.index', compact('product2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('product2.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Product2::create($requestData);

        return redirect('product2')->with('flash_message', 'Product2 added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product2 = Product2::findOrFail($id);

        return view('product2.show', compact('product2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product2 = Product2::findOrFail($id);

        return view('product2.edit', compact('product2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $product2 = Product2::findOrFail($id);
        $product2->update($requestData);

        return redirect('product2')->with('flash_message', 'Product2 updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product2::destroy($id);

        return redirect('product2')->with('flash_message', 'Product2 deleted!');
    }
}
