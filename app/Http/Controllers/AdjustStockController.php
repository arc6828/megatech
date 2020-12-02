<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdjustStock;
use App\AdjustStockDetail;
use App\ProductModel;
use App\GaurdStock;
use Illuminate\Http\Request;

class AdjustStockController extends Controller
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
            $adjuststock = AdjustStock::where('code', 'LIKE', "%$keyword%")
                ->orWhere('reference', 'LIKE', "%$keyword%")
                ->orWhere('adjust_type', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('adjust_definition_id', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('revision', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $adjuststock = AdjustStock::latest()->paginate($perPage);
        }

        return view('adjust-stock.index', compact('adjuststock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('adjust-stock.create');
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
        $requestData["code"] = $this->getNewCode();
        $requestData["revision"] = 0;              
        $requestData["status_id"] = 1;  
        $adjuststock = AdjustStock::create($requestData);
        $this->store_detail($request, $adjuststock);

        return redirect('adjust-stock/'.$adjuststock->id)->with('flash_message', 'AdjustStock added!');
    }

    public function getNewCode(){
        $number = AdjustStock::where('status_id','!=','-1')
            ->whereMonth('created_at',date("m"))
            ->whereYear('created_at',date("Y"))
            ->count();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "AJ{$year}{$month}-{$number}";
        return $code;
    }

    public function store_detail(Request $request, $adjuststock){
        //CREATE RETURN INVOICE DETAIL
        $details = [];
        $products = $request->input('product_ids');
        $amounts = $request->input('amounts');
        //$discount_prices = $request->input('discount_prices');
        //$totals = $request->input('totals');
        if (is_array($products)){
          for($i=0; $i<count($products); $i++){
            $details[] = [
                "product_id" => $products[$i],
                "amount" => $amounts[$i],
                //"discount_price" => $discount_prices[$i],
                //"total" => $totals[$i],
                "adjust_id" => $adjuststock->id,              
            ];
          }
        }
        AdjustStockDetail::insert($details);

        //GAURD STOCK UPDATE
        foreach($details as $item){
            if($item['amount'] == 0){
                continue;
            }
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $adjuststock->code,
                "type" => "adjust_stock",
                "amount" => $item['amount'],
                "amount_in_stock" => ($product->amount_in_stock + ($adjuststock->adjust_type * $item['amount']) ),
                "pending_in" => $product->pending_in,
                "pending_out" => ($product->pending_out),
                "product_id" => $product->product_id,
            ]);
            
            //PRODUCT UPDATE : amount_in_stock , pending_in , pending_out
            $product->amount_in_stock = $gaurd_stock['amount_in_stock'];
            $product->pending_in = $gaurd_stock['pending_in'];
            $product->pending_out = $gaurd_stock['pending_out'];
            $product->save();
        }
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
        $adjuststock = AdjustStock::findOrFail($id);
        $adjuststockdetail = $adjuststock->details()->get();
        $mode = "show";

        return view('adjust-stock.edit', compact('adjuststock','adjuststockdetail','mode'));
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
        $adjuststock = AdjustStock::findOrFail($id);
        $adjuststockdetail = $adjuststock->details()->get();
        $mode = "edit";
        return view('adjust-stock.edit', compact('adjuststock','adjuststockdetail','mode'));
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
        
        $adjuststock = AdjustStock::findOrFail($id);
        $adjuststock->update($requestData);

        return redirect('adjust-stock')->with('flash_message', 'AdjustStock updated!');
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
        AdjustStock::destroy($id);

        return redirect('adjust-stock')->with('flash_message', 'AdjustStock deleted!');
    }
}
