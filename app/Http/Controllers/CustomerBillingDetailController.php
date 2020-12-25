<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerBillingDetail;
use Illuminate\Http\Request;

class CustomerBillingDetailController extends Controller
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
            $customerbillingdetail = CustomerBillingDetail::where('doc_id', 'LIKE', "%$keyword%")
                ->orWhere('customer_billing_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customerbillingdetail = CustomerBillingDetail::latest()->paginate($perPage);
        }

        return view('customer-billing-detail.index', compact('customerbillingdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer-billing-detail.create');
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
        
        CustomerBillingDetail::create($requestData);

        return redirect('customer-billing-detail')->with('flash_message', 'CustomerBillingDetail added!');
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
        $customerbillingdetail = CustomerBillingDetail::findOrFail($id);

        return view('customer-billing-detail.show', compact('customerbillingdetail'));
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
        $customerbillingdetail = CustomerBillingDetail::findOrFail($id);

        return view('customer-billing-detail.edit', compact('customerbillingdetail'));
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
        
        $customerbillingdetail = CustomerBillingDetail::findOrFail($id);
        $customerbillingdetail->update($requestData);

        return redirect('customer-billing-detail')->with('flash_message', 'CustomerBillingDetail updated!');
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
        CustomerBillingDetail::destroy($id);

        return redirect('customer-billing-detail')->with('flash_message', 'CustomerBillingDetail deleted!');
    }
}
