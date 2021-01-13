<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReceiveFinalDetail;
use Illuminate\Http\Request;

class ReceiveFinalDetailController extends Controller
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
            $receivefinaldetail = ReceiveFinalDetail::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('discount_price', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('receive_final_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $receivefinaldetail = ReceiveFinalDetail::latest()->paginate($perPage);
        }

        return view('receive-final-detail.index', compact('receivefinaldetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('receive-final-detail.create');
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
        
        ReceiveFinalDetail::create($requestData);

        return redirect('receive-final-detail')->with('flash_message', 'ReceiveFinalDetail added!');
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
        $receivefinaldetail = ReceiveFinalDetail::findOrFail($id);

        return view('receive-final-detail.show', compact('receivefinaldetail'));
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
        $receivefinaldetail = ReceiveFinalDetail::findOrFail($id);

        return view('receive-final-detail.edit', compact('receivefinaldetail'));
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
        
        $receivefinaldetail = ReceiveFinalDetail::findOrFail($id);
        $receivefinaldetail->update($requestData);

        return redirect('receive-final-detail')->with('flash_message', 'ReceiveFinalDetail updated!');
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
        ReceiveFinalDetail::destroy($id);

        return redirect('receive-final-detail')->with('flash_message', 'ReceiveFinalDetail deleted!');
    }
}
