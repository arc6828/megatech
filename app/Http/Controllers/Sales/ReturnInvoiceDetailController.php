<?php

namespace App\Http\Controllers\Sales;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReturnInvoiceDetail;
use Illuminate\Http\Request;

class ReturnInvoiceDetailController extends Controller
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
            $returninvoicedetail = ReturnInvoiceDetail::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('discount_price', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('return_invoice_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $returninvoicedetail = ReturnInvoiceDetail::latest()->paginate($perPage);
        }

        return view('sales.return-invoice-detail.index', compact('returninvoicedetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sales.return-invoice-detail.create');
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
        
        ReturnInvoiceDetail::create($requestData);

        return redirect('sales/return-invoice-detail')->with('flash_message', 'ReturnInvoiceDetail added!');
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
        $returninvoicedetail = ReturnInvoiceDetail::findOrFail($id);

        return view('sales.return-invoice-detail.show', compact('returninvoicedetail'));
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
        $returninvoicedetail = ReturnInvoiceDetail::findOrFail($id);

        return view('sales.return-invoice-detail.edit', compact('returninvoicedetail'));
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
        
        $returninvoicedetail = ReturnInvoiceDetail::findOrFail($id);
        $returninvoicedetail->update($requestData);

        return redirect('sales/return-invoice-detail')->with('flash_message', 'ReturnInvoiceDetail updated!');
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
        ReturnInvoiceDetail::destroy($id);

        return redirect('sales/return-invoice-detail')->with('flash_message', 'ReturnInvoiceDetail deleted!');
    }
}
