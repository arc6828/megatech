<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\IssueStockDetail;
use Illuminate\Http\Request;

class IssueStockDetailController extends Controller
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
            $issuestockdetail = IssueStockDetail::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('discount_price', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('issue_stock_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $issuestockdetail = IssueStockDetail::latest()->paginate($perPage);
        }

        return view('issue-stock-detail.index', compact('issuestockdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('issue-stock-detail.create');
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
        
        IssueStockDetail::create($requestData);

        return redirect('issue-stock-detail')->with('flash_message', 'IssueStockDetail added!');
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
        $issuestockdetail = IssueStockDetail::findOrFail($id);

        return view('issue-stock-detail.show', compact('issuestockdetail'));
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
        $issuestockdetail = IssueStockDetail::findOrFail($id);

        return view('issue-stock-detail.edit', compact('issuestockdetail'));
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
        
        $issuestockdetail = IssueStockDetail::findOrFail($id);
        $issuestockdetail->update($requestData);

        return redirect('issue-stock-detail')->with('flash_message', 'IssueStockDetail updated!');
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
        IssueStockDetail::destroy($id);

        return redirect('issue-stock-detail')->with('flash_message', 'IssueStockDetail deleted!');
    }
}
