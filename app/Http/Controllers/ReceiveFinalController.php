<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\IssueStock;
use App\ReceiveFinal;
use App\ReceiveFinalDetail;
use App\ProductModel;
use App\GaurdStock;
use Illuminate\Http\Request;

class ReceiveFinalController extends Controller
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
        //     $receivefinal = ReceiveFinal::where('code', 'LIKE', "%$keyword%")
        //         ->orWhere('is_code', 'LIKE', "%$keyword%")
        //         ->orWhere('status_id', 'LIKE', "%$keyword%")
        //         ->orWhere('user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('remark', 'LIKE', "%$keyword%")
        //         ->orWhere('total', 'LIKE', "%$keyword%")
        //         ->orWhere('revision', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $receivefinal = ReceiveFinal::latest()->paginate($perPage);
        // }
        $receivefinal = ReceiveFinal::latest()->get();

        return view('receive-final.index', compact('receivefinal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $is_code = $request->get('is_code');
        $issuestock = IssueStock::where('code',$is_code)->first();


        $receivefinal = new ReceiveFinal;
        $receivefinal->is_code = $is_code;
        $receivefinaldetail = [];
        if(isset($issuestock)){
            $receivefinaldetail[] = $issuestock;
        }
        $issuestocks = IssueStock::where('status_id','1')->get();
        return view('receive-final.create', compact('receivefinal','receivefinaldetail','issuestocks'));
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
        $receivefinal = ReceiveFinal::create($requestData);
        $this->store_detail($request, $receivefinal);

        //CHANGE status_id = 2 for issue stock : done
        $issuestock = IssueStock::where('code',$receivefinal->is_code)->first();
        $issuestock->status_id = 2;
        $issuestock->save();


        return redirect('receive-final/'.$receivefinal->id)->with('flash_message', 'ReceiveFinal added!');
    }
    public function getNewCode(){
        $number = ReceiveFinal::where('status_id','!=','-1')
            ->whereMonth('created_at',date("m"))
            ->whereYear('created_at',date("Y"))
            ->count();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "RF{$year}{$month}-{$number}";
        return $code;
    }

    public function store_detail(Request $request, $receivefinal){
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
                "receive_final_id" => $receivefinal->id,              
            ];
          }
        }
        ReceiveFinalDetail::insert($details);

        //GAURD STOCK UPDATE
        foreach($details as $item){
            if($item['amount'] == 0){
                continue;
            }
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $receivefinal->code,
                "type" => "receive_final",
                "amount" => $item['amount'],
                "amount_in_stock" => ($product->amount_in_stock + $item['amount']),
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
        $receivefinal = ReceiveFinal::findOrFail($id);
        $receivefinaldetail = $receivefinal->details()->get();
        $mode = "show";
        return view('receive-final.edit', compact('receivefinal','receivefinaldetail','mode'));
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
        $receivefinal = ReceiveFinal::findOrFail($id);
        $receivefinaldetail = $receivefinal->details()->get();
        $mode = "edit";

        return view('receive-final.edit', compact('receivefinal','receivefinaldetail','mode'));
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
        
        $receivefinal = ReceiveFinal::findOrFail($id);
        $receivefinal->update($requestData);

        return redirect('receive-final')->with('flash_message', 'ReceiveFinal updated!');
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
        ReceiveFinal::destroy($id);

        return redirect('receive-final')->with('flash_message', 'ReceiveFinal deleted!');
    }
}
