<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerPaymentDetail;
use Illuminate\Http\Request;

class CustomerPaymentDetailController extends Controller
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
            $customerpaymentdetail = CustomerPaymentDetail::where('doc_id', 'LIKE', "%$keyword%")
                ->orWhere('customer_billing_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customerpaymentdetail = CustomerPaymentDetail::latest()->paginate($perPage);
        }

        return view('customer-payment-detail.index', compact('customerpaymentdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer-payment-detail.create');
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
        
        CustomerPaymentDetail::create($requestData);

        return redirect('customer-payment-detail')->with('flash_message', 'CustomerPaymentDetail added!');
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
        $customerpaymentdetail = CustomerPaymentDetail::findOrFail($id);

        return view('customer-payment-detail.show', compact('customerpaymentdetail'));
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
        $customerpaymentdetail = CustomerPaymentDetail::findOrFail($id);

        return view('customer-payment-detail.edit', compact('customerpaymentdetail'));
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
        
        $customerpaymentdetail = CustomerPaymentDetail::findOrFail($id);
        $customerpaymentdetail->update($requestData);

        return redirect('customer-payment-detail')->with('flash_message', 'CustomerPaymentDetail updated!');
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
        CustomerPaymentDetail::destroy($id);

        return redirect('customer-payment-detail')->with('flash_message', 'CustomerPaymentDetail deleted!');
    }
}
