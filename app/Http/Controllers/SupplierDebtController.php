<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SupplierDebt;
use Illuminate\Http\Request;

class SupplierDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $keyword = $request->get('search');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     $supplierdebt = SupplierDebt::where('doc_no', 'LIKE', "%$keyword%")
        //         ->orWhere('date', 'LIKE', "%$keyword%")
        //         ->orWhere('supplier_id', 'LIKE', "%$keyword%")
        //         ->orWhere('discount', 'LIKE', "%$keyword%")
        //         ->orWhere('amount', 'LIKE', "%$keyword%")
        //         ->orWhere('vat_percent', 'LIKE', "%$keyword%")
        //         ->orWhere('vat', 'LIKE', "%$keyword%")
        //         ->orWhere('total_before_vat', 'LIKE', "%$keyword%")
        //         ->orWhere('total', 'LIKE', "%$keyword%")
        //         ->orWhere('tax_type_id', 'LIKE', "%$keyword%")
        //         ->orWhere('completed_at', 'LIKE', "%$keyword%")
        //         ->orWhere('tax_category', 'LIKE', "%$keyword%")
        //         ->orWhere('round', 'LIKE', "%$keyword%")
        //         ->orWhere('type_debt', 'LIKE', "%$keyword%")
        //         ->orWhere('debt_duration', 'LIKE', "%$keyword%")
        //         ->orWhere('user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('role', 'LIKE', "%$keyword%")
        //         ->orWhere('reference', 'LIKE', "%$keyword%")
        //         ->orWhere('zone_id', 'LIKE', "%$keyword%")
        //         ->orWhere('cheque_id', 'LIKE', "%$keyword%")
        //         ->orWhere('payment_method', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $supplierdebt = SupplierDebt::latest()->paginate($perPage);
        // }
        $type_debt = $request->get('type_debt');
        $supplierdebt = SupplierDebt::where('type_debt',$type_debt)->orderBy('doc_no','desc')->get();
        return view('supplier-debt.index', compact('supplierdebt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('supplier-debt.create');
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
        
        SupplierDebt::create($requestData);

        return redirect('supplier-debt')->with('flash_message', 'SupplierDebt added!');
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
        $supplierdebt = SupplierDebt::findOrFail($id);

        return view('supplier-debt.show', compact('supplierdebt'));
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
        $supplierdebt = SupplierDebt::findOrFail($id);

        return view('supplier-debt.edit', compact('supplierdebt'));
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
        
        $supplierdebt = SupplierDebt::findOrFail($id);
        $supplierdebt->update($requestData);

        return redirect('supplier-debt')->with('flash_message', 'SupplierDebt updated!');
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
        SupplierDebt::destroy($id);

        return redirect('supplier-debt')->with('flash_message', 'SupplierDebt deleted!');
    }
}
