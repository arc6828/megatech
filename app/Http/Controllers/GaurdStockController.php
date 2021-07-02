<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GaurdStock;
use App\ProductModel;
use Illuminate\Http\Request;

class GaurdStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product_id = $request->get('product_id');
        $since = $request->get('since',date('Y-m-d'));
    

        $product = ProductModel::where('product_id',$product_id)->firstOrFail();
        $whitelist = [
            'sales_invoice','sales_invoice_cancel',
            'purchase_receive','purchase_receive_cancel',
            'sales_dt_create', 'sales_dt_cancel', 'sales_dt_void',
            'sales_return_invoice', 'sales_return_invoice_cancel',
            'purchase_return_order', 'purchase_return_order_cancel',
            'issue_stock', 'issue_stock_cancel',
            'receive_final', 'receive_final_cancel',
            'adjust_stock', 'adjust_stock_cancel',
        ];
        $gaurdstock = GaurdStock::where('product_id',  $product_id)   
            ->whereDate('created_at','>=',$since)             
            // ->whereIn('type', $whitelist) //"type" => "",
            ->oldest()->get();
        $mode = "gaurd-stock";

        $last = GaurdStock::where('product_id',  $product_id)   
            ->whereDate('created_at','<',$since)             
            // ->whereIn('type', $whitelist) //"type" => "",
            ->latest()->first();
        if( isset($last) ){
            $product->amount_in_stock_default = $last->amount_in_stock;
            $product->date_default = $since." 00:00:00";
        }

        return view('gaurd-stock.index', compact('gaurdstock','mode','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('gaurd-stock.create');
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
        
        GaurdStock::create($requestData);

        return redirect('gaurd-stock')->with('flash_message', 'GaurdStock added!');
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
        $gaurdstock = GaurdStock::findOrFail($id);

        return view('gaurd-stock.show', compact('gaurdstock'));
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
        $gaurdstock = GaurdStock::findOrFail($id);

        return view('gaurd-stock.edit', compact('gaurdstock'));
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
        
        $gaurdstock = GaurdStock::findOrFail($id);
        $gaurdstock->update($requestData);

        return redirect('gaurd-stock')->with('flash_message', 'GaurdStock updated!');
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
        GaurdStock::destroy($id);

        return redirect('gaurd-stock')->with('flash_message', 'GaurdStock deleted!');
    }
}
