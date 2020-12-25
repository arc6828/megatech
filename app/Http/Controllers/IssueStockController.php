<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\IssueStock;
use App\IssueStockDetail;
use App\ProductModel;
use App\GaurdStock;
use Illuminate\Http\Request;

class IssueStockController extends Controller
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
            $issuestock = IssueStock::where('code', 'LIKE', "%$keyword%")
                ->orWhere('product_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('status_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('revision', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $issuestock = IssueStock::latest()->paginate($perPage);
        }

        return view('issue-stock.index', compact('issuestock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('issue-stock.create');
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
        $issuestock = IssueStock::create($requestData);

        $this->store_detail($request, $issuestock);

        return redirect('issue-stock/'.$issuestock->id)->with('flash_message', 'IssueStock added!');
    }

    public function getNewCode(){
        $number = IssueStock::where('status_id','!=','-1')
            ->whereMonth('created_at',date("m"))
            ->whereYear('created_at',date("Y"))
            ->count();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "IS{$year}{$month}-{$number}";
        return $code;
    }

    public function store_detail(Request $request, $issuestock){
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
                "issue_stock_id" => $issuestock->id,              
            ];
          }
        }
        IssueStockDetail::insert($details);

        //GAURD STOCK UPDATE
        foreach($details as $item){
            if($item['amount'] == 0){
                continue;
            }
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $issuestock->code,
                "type" => "issue_stock",
                "amount" => $item['amount'],
                "amount_in_stock" => ($product->amount_in_stock - $item['amount']),
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
        $issuestock = IssueStock::findOrFail($id); 
        $issuestockdetail = $issuestock->details()->get();
        $mode = "show";

        return view('issue-stock.edit', compact('issuestock','issuestockdetail','mode'));
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
        $issuestock = IssueStock::findOrFail($id);        
        $issuestockdetail = $issuestock->details()->get();
        $mode = "edit";
        

        return view('issue-stock.edit', compact('issuestock','issuestockdetail','mode'));
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
        
        $issuestock = IssueStock::findOrFail($id);
        $issuestock->update($requestData);

        return redirect('issue-stock')->with('flash_message', 'IssueStock updated!');
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
        IssueStock::destroy($id);

        return redirect('issue-stock')->with('flash_message', 'IssueStock deleted!');
    }
}
