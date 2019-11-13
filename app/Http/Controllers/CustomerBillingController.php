<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sales\InvoiceModel;
use App\CustomerModel;
use App\CustomerBilling;
use Illuminate\Http\Request;

class CustomerBillingController extends Controller
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
            $customerbilling = CustomerBilling::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('condition_billing', 'LIKE', "%$keyword%")
                ->orWhere('condition_cheque', 'LIKE', "%$keyword%")
                ->orWhere('date_billing', 'LIKE', "%$keyword%")
                ->orWhere('date_cheque', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customerbilling = CustomerBilling::latest()->paginate($perPage);
        }

        return view('customer-billing.index', compact('customerbilling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customer_id = request('customer_id',0);
        $customer = CustomerModel::find($customer_id);
        $table_invoice = InvoiceModel::where('customer_id', $customer_id)
            ->where('total_debt','>',0)
            ->get();
        return view('customer-billing.create', compact('table_invoice','customer') );
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
        
        CustomerBilling::create($requestData);

        return redirect('customer-billing')->with('flash_message', 'CustomerBilling added!');
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
        $customerbilling = CustomerBilling::findOrFail($id);

        return view('customer-billing.show', compact('customerbilling'));
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
        $customerbilling = CustomerBilling::findOrFail($id);

        return view('customer-billing.edit', compact('customerbilling'));
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
        
        $customerbilling = CustomerBilling::findOrFail($id);
        $customerbilling->update($requestData);

        return redirect('customer-billing')->with('flash_message', 'CustomerBilling updated!');
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
        CustomerBilling::destroy($id);

        return redirect('customer-billing')->with('flash_message', 'CustomerBilling deleted!');
    }
}
