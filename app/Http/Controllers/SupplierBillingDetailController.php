<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SupplierBillingDetail;
use Illuminate\Http\Request;

class SupplierBillingDetailController extends Controller
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
            $supplierbillingdetail = SupplierBillingDetail::where('doc_id', 'LIKE', "%$keyword%")
                ->orWhere('supplier_billing_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $supplierbillingdetail = SupplierBillingDetail::latest()->paginate($perPage);
        }

        return view('supplier-billing-detail.index', compact('supplierbillingdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('supplier-billing-detail.create');
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
        
        SupplierBillingDetail::create($requestData);

        return redirect('supplier-billing-detail')->with('flash_message', 'SupplierBillingDetail added!');
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
        $supplierbillingdetail = SupplierBillingDetail::findOrFail($id);

        return view('supplier-billing-detail.show', compact('supplierbillingdetail'));
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
        $supplierbillingdetail = SupplierBillingDetail::findOrFail($id);

        return view('supplier-billing-detail.edit', compact('supplierbillingdetail'));
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
        
        $supplierbillingdetail = SupplierBillingDetail::findOrFail($id);
        $supplierbillingdetail->update($requestData);

        return redirect('supplier-billing-detail')->with('flash_message', 'SupplierBillingDetail updated!');
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
        SupplierBillingDetail::destroy($id);

        return redirect('supplier-billing-detail')->with('flash_message', 'SupplierBillingDetail deleted!');
    }
}
