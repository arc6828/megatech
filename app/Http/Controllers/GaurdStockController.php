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
        // $hidden = $request->get('hidden');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     if(empty($hidden)){
        //         $whitelist = [
        //             'sales_invoice',
        //             'purchase_receive',
        //             'sales_dt_create', 'sales_dt_cancel', 'sales_dt_void',
        //             'sales_return_invoice', 'sales_return_invoice_cancel',
        //             'purchase_return_order', 'purchase_return_order_cancel',
        //             'issue_stock', 'issue_stock_cancel',
        //             'receive_final', 'receive_final_cancel',
        //         ];
        //         $gaurdstock = GaurdStock::where('product_id',  $keyword)                
        //         ->whereIn('type', $whitelist) //"type" => "",
        //         ->latest()->paginate($perPage);
        //     }else{
        //         $gaurdstock = GaurdStock::where('product_id',  $keyword)
        //         //->whereIn('type',['sales_invocie','purchase_receive'])
        //         ->latest()->paginate($perPage);
        //     }
            
        // } else {
        //     $gaurdstock = GaurdStock::latest()->paginate($perPage);
        // }

        $product = ProductModel::where('product_id',$product_id)->firstOrFail();
        $whitelist = [
            'sales_invoice',
            'purchase_receive',
            'sales_dt_create', 'sales_dt_cancel', 'sales_dt_void',
            'sales_return_invoice', 'sales_return_invoice_cancel',
            'purchase_return_order', 'purchase_return_order_cancel',
            'issue_stock', 'issue_stock_cancel',
            'receive_final', 'receive_final_cancel',
        ];
        $gaurdstock = GaurdStock::where('product_id',  $product_id)                
            ->whereIn('type', $whitelist) //"type" => "",
            ->latest()->get();
        $mode = "gaurd-stock";

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
