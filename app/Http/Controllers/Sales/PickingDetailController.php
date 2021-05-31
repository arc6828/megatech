<?php

namespace App\Http\Controllers\Sales;
use App\Http\Controllers\Controller;

use App\Sales\PickingDetail;
use Illuminate\Http\Request;

class PickingDetailController extends Controller
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
            $pickingdetail = PickingDetail::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('approved_amount', 'LIKE', "%$keyword%")
                ->orWhere('iv_amount', 'LIKE', "%$keyword%")
                ->orWhere('before_approved_amount', 'LIKE', "%$keyword%")
                ->orWhere('discount_price', 'LIKE', "%$keyword%")
                ->orWhere('order_id', 'LIKE', "%$keyword%")
                ->orWhere('order_detail_status_id', 'LIKE', "%$keyword%")
                ->orWhere('invoice_code', 'LIKE', "%$keyword%")
                ->orWhere('danger_price', 'LIKE', "%$keyword%")
                ->orWhere('picking_code', 'LIKE', "%$keyword%")
                ->orWhere('sale_status_id', 'LIKE', "%$keyword%")
                ->orWhere('quotation_code', 'LIKE', "%$keyword%")
                ->orWhere('delivery_duration', 'LIKE', "%$keyword%")
                ->orWhere('sales_picking_detail_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pickingdetail = PickingDetail::latest()->paginate($perPage);
        }

        return view('picking-detail.index', compact('pickingdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('picking-detail.create');
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

        PickingDetail::create($requestData);

        return redirect('picking-detail')->with('flash_message', 'PickingDetail added!');
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
        $pickingdetail = PickingDetail::findOrFail($id);

        return view('picking-detail.show', compact('pickingdetail'));
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
        $pickingdetail = PickingDetail::findOrFail($id);

        return view('picking-detail.edit', compact('pickingdetail'));
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

        $pickingdetail = PickingDetail::findOrFail($id);
        $pickingdetail->update($requestData);

        return redirect('picking-detail')->with('flash_message', 'PickingDetail updated!');
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
        PickingDetail::destroy($id);

        return redirect('picking-detail')->with('flash_message', 'PickingDetail deleted!');
    }
}
