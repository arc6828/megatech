<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BankTransaction;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
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
            $banktransaction = BankTransaction::where('code', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('balance', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $banktransaction = BankTransaction::latest()->paginate($perPage);
        }

        return view('bank-transaction.index', compact('banktransaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('bank-transaction.create');
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
        
        BankTransaction::create($requestData);

        return redirect('bank-transaction')->with('flash_message', 'BankTransaction added!');
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
        $banktransaction = BankTransaction::findOrFail($id);

        return view('bank-transaction.show', compact('banktransaction'));
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
        $banktransaction = BankTransaction::findOrFail($id);

        return view('bank-transaction.edit', compact('banktransaction'));
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
        
        $banktransaction = BankTransaction::findOrFail($id);
        $banktransaction->update($requestData);

        return redirect('bank-transaction')->with('flash_message', 'BankTransaction updated!');
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
        BankTransaction::destroy($id);

        return redirect('bank-transaction')->with('flash_message', 'BankTransaction deleted!');
    }
}
