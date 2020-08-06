<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerDebt;
use Illuminate\Http\Request;

class CustomerDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /*
        if (!empty($keyword)) {
            
            $keyword = $request->get('search');
            $customerdebt = CustomerDebt::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('vat_percent', 'LIKE', "%$keyword%")
                ->orWhere('vat', 'LIKE', "%$keyword%")
                ->orWhere('total_before_vat', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('tax_type_id', 'LIKE', "%$keyword%")
                ->orWhere('completed_at', 'LIKE', "%$keyword%")
                ->orWhere('tax_category', 'LIKE', "%$keyword%")
                ->orWhere('round', 'LIKE', "%$keyword%")
                ->orWhere('type_debt', 'LIKE', "%$keyword%")
                ->orWhere('debt_duration', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->orWhere('reference', 'LIKE', "%$keyword%")
                ->orWhere('zone_id', 'LIKE', "%$keyword%")
                ->orWhere('cheque_id', 'LIKE', "%$keyword%")
                ->orWhere('payment_method', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customerdebt = CustomerDebt::latest()->paginate($perPage);
        }
        */
        
        $perPage = 2500;

        $type_debt = $request->get('type_debt');

        $customerdebt = CustomerDebt::where('type_debt',$type_debt)->latest()->paginate($perPage);

        return view('customer-debt.index', compact('customerdebt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer-debt.create');
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
        
        CustomerDebt::create($requestData);

        return redirect('customer-debt')->with('flash_message', 'CustomerDebt added!');
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
        $customerdebt = CustomerDebt::findOrFail($id);

        return view('customer-debt.show', compact('customerdebt'));
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
        $customerdebt = CustomerDebt::findOrFail($id);

        return view('customer-debt.edit', compact('customerdebt'));
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
        
        $customerdebt = CustomerDebt::findOrFail($id);
        $customerdebt->update($requestData);

        return redirect('customer-debt')->with('flash_message', 'CustomerDebt updated!');
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
        CustomerDebt::destroy($id);

        return redirect('customer-debt')->with('flash_message', 'CustomerDebt deleted!');
    }
}
