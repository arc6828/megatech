<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cheque;
use App\BankAccount;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('cheque_type_code');
        $perPage = 25;

        if (!empty($keyword)) {
            $cheque = Cheque::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('cheque_date', 'LIKE', "%$keyword%")
                ->orWhere('cheque_type_code', 'LIKE', "%$keyword%")
                ->orWhere('cheque_no', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('bank_fee', 'LIKE', "%$keyword%")
                ->orWhere('bank_account_id', 'LIKE', "%$keyword%")
                ->orWhere('passed_cheque_date', 'LIKE', "%$keyword%")
                ->orWhere('reference', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $cheque = Cheque::latest()->paginate($perPage);
        }

        return view('cheque.index', compact('cheque'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $bank_accounts = BankAccount::all();
        return view('cheque.create', compact('bank_accounts'));
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
        
        Cheque::create($requestData);

        return redirect("/finance/cheque?cheque_type_code=".request('cheque_type_code'))->with('flash_message', 'Cheque added!');
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
        $cheque = Cheque::findOrFail($id);

        return view('cheque.show', compact('cheque'));
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
        $cheque = Cheque::findOrFail($id);
        
        $bank_accounts = BankAccount::all();

        return view('cheque.edit', compact('cheque','bank_accounts'));
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
        
        $cheque = Cheque::findOrFail($id);
        $cheque->update($requestData);

        return redirect("/finance/cheque?cheque_type_code=".request('cheque_type_code'))->with('flash_message', 'Cheque updated!');
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
        Cheque::destroy($id);

        return redirect('cheque')->with('flash_message', 'Cheque deleted!');
    }
}
