<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Purchase\ReturnOrderDetail;
use Illuminate\Http\Request;

class ReturnOrderDetailController extends Controller
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
            $returnorderdetail = ReturnOrderDetail::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('discount_price', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('return_order_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $returnorderdetail = ReturnOrderDetail::latest()->paginate($perPage);
        }

        return view('purchase.return-order-detail.index', compact('returnorderdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('purchase.return-order-detail.create');
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
        
        ReturnOrderDetail::create($requestData);

        return redirect('purchase/return-order-detail')->with('flash_message', 'ReturnOrderDetail added!');
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
        $returnorderdetail = ReturnOrderDetail::findOrFail($id);

        return view('purchase.return-order-detail.show', compact('returnorderdetail'));
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
        $returnorderdetail = ReturnOrderDetail::findOrFail($id);

        return view('purchase.return-order-detail.edit', compact('returnorderdetail'));
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
        
        $returnorderdetail = ReturnOrderDetail::findOrFail($id);
        $returnorderdetail->update($requestData);

        return redirect('purchase/return-order-detail')->with('flash_message', 'ReturnOrderDetail updated!');
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
        ReturnOrderDetail::destroy($id);

        return redirect('purchase/return-order-detail')->with('flash_message', 'ReturnOrderDetail deleted!');
    }
}
