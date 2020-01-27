<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
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
            $checklist = Checklist::where('billing_invoice', 'LIKE', "%$keyword%")
                ->orWhere('billing_po', 'LIKE', "%$keyword%")
                ->orWhere('billing_receipt', 'LIKE', "%$keyword%")
                ->orWhere('billing_envelope', 'LIKE', "%$keyword%")
                ->orWhere('billing_delivery', 'LIKE', "%$keyword%")
                ->orWhere('billing_reference', 'LIKE', "%$keyword%")
                ->orWhere('cheque_billing', 'LIKE', "%$keyword%")
                ->orWhere('cheque_receipt', 'LIKE', "%$keyword%")
                ->orWhere('cheque_po', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('supplier_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $checklist = Checklist::latest()->paginate($perPage);
        }

        return view('checklist.index', compact('checklist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('checklist.create');
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
        
        Checklist::create($requestData);

        return redirect('checklist')->with('flash_message', 'Checklist added!');
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
        $checklist = Checklist::findOrFail($id);

        return view('checklist.show', compact('checklist'));
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
        $checklist = Checklist::findOrFail($id);

        return view('checklist.edit', compact('checklist'));
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
        
        $checklist = Checklist::findOrFail($id);
        $checklist->update($requestData);

        return redirect('checklist')->with('flash_message', 'Checklist updated!');
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
        Checklist::destroy($id);

        return redirect('checklist')->with('flash_message', 'Checklist deleted!');
    }
}
