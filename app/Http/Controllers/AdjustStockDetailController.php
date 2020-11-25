<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdjustStockDetail;
use Illuminate\Http\Request;

class AdjustStockDetailController extends Controller
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
            $adjuststockdetail = AdjustStockDetail::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('discount_price', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('adjust_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $adjuststockdetail = AdjustStockDetail::latest()->paginate($perPage);
        }

        return view('adjust-stock-detail.index', compact('adjuststockdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('adjust-stock-detail.create');
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
        
        AdjustStockDetail::create($requestData);

        return redirect('adjust-stock-detail')->with('flash_message', 'AdjustStockDetail added!');
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
        $adjuststockdetail = AdjustStockDetail::findOrFail($id);

        return view('adjust-stock-detail.show', compact('adjuststockdetail'));
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
        $adjuststockdetail = AdjustStockDetail::findOrFail($id);

        return view('adjust-stock-detail.edit', compact('adjuststockdetail'));
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
        
        $adjuststockdetail = AdjustStockDetail::findOrFail($id);
        $adjuststockdetail->update($requestData);

        return redirect('adjust-stock-detail')->with('flash_message', 'AdjustStockDetail updated!');
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
        AdjustStockDetail::destroy($id);

        return redirect('adjust-stock-detail')->with('flash_message', 'AdjustStockDetail deleted!');
    }
}
