<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SupplierPaymentDetail;
use Illuminate\Http\Request;

class SupplierPaymentDetailController extends Controller
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
            $supplierpaymentdetail = SupplierPaymentDetail::where('doc_id', 'LIKE', "%$keyword%")
                ->orWhere('supplier_billing_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $supplierpaymentdetail = SupplierPaymentDetail::latest()->paginate($perPage);
        }

        return view('supplier-payment-detail.index', compact('supplierpaymentdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('supplier-payment-detail.create');
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
        
        SupplierPaymentDetail::create($requestData);

        return redirect('supplier-payment-detail')->with('flash_message', 'SupplierPaymentDetail added!');
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
        $supplierpaymentdetail = SupplierPaymentDetail::findOrFail($id);

        return view('supplier-payment-detail.show', compact('supplierpaymentdetail'));
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
        $supplierpaymentdetail = SupplierPaymentDetail::findOrFail($id);

        return view('supplier-payment-detail.edit', compact('supplierpaymentdetail'));
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
        
        $supplierpaymentdetail = SupplierPaymentDetail::findOrFail($id);
        $supplierpaymentdetail->update($requestData);

        return redirect('supplier-payment-detail')->with('flash_message', 'SupplierPaymentDetail updated!');
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
        SupplierPaymentDetail::destroy($id);

        return redirect('supplier-payment-detail')->with('flash_message', 'SupplierPaymentDetail deleted!');
    }
}
