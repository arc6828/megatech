<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Purchase\ReturnOrder;
use App\Purchase\ReturnOrderDetail;
use App\Purchase\ReceiveModel;
use App\ProductModel;
use App\GaurdStock;

use Illuminate\Http\Request;

class ReturnOrderController extends Controller
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

        // if (!empty($keyword)) {
        //     $returnorder = ReturnOrder::where('code', 'LIKE', "%$keyword%")
        //         ->orWhere('supplier_id', 'LIKE', "%$keyword%")
        //         ->orWhere('purchase_receive_code', 'LIKE', "%$keyword%")
        //         ->orWhere('tax_type_id', 'LIKE', "%$keyword%")
        //         ->orWhere('purchase_status_id', 'LIKE', "%$keyword%")
        //         ->orWhere('user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('remark', 'LIKE', "%$keyword%")
        //         ->orWhere('total_before_vat', 'LIKE', "%$keyword%")
        //         ->orWhere('vat', 'LIKE', "%$keyword%")
        //         ->orWhere('vat_percent', 'LIKE', "%$keyword%")
        //         ->orWhere('total_after_vat', 'LIKE', "%$keyword%")
        //         ->orWhere('revision', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $returnorder = ReturnOrder::latest()->paginate($perPage);
        // }
        $returnorder = ReturnOrder::latest()->get();

        return view('purchase.return-order.index', compact('returnorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $keyword = $request->get('search');
        $returnorder = ReceiveModel::firstOrNew(['purchase_receive_code'=> $keyword]);
        $returnorder->total_before_vat = 0;
        $returnorder->total_after_vat = 0;
        $returnorder->vat = 0;
        $returnorderdetail = isset($returnorder) ? $returnorder->purchase_receive_details()->get() : [];

        return view('purchase.return-order.create',compact('returnorder','returnorderdetail'));
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
        //CREATE RETURN INVOICE
        $requestData = $request->all();        
        $requestData["code"] = $this->getNewCode();
        $requestData["revision"] = 0;        
        $returnorder = ReturnOrder::create($requestData);

        $this->store_detail($request, $returnorder);

        return redirect('purchase/return-order/'.$returnorder->id)->with('flash_message', 'ReturnOrder added!');
    }

    public function getNewCode(){
        $number = ReturnOrder::where('purchase_status_id','!=','-1')
            ->whereMonth('created_at',date("m"))
            ->whereYear('created_at',date("Y"))
            ->count();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "RO{$year}{$month}-{$number}";
        return $code;
    }

    public function store_detail(Request $request, $returnorder){
        //CREATE RETURN INVOICE DETAIL
        $details = [];
        $products = $request->input('product_ids');
        $amounts = $request->input('amounts');
        $discount_prices = $request->input('discount_prices');
        $totals = $request->input('totals');
        if (is_array($products)){
          for($i=0; $i<count($products); $i++){
            $details[] = [
                "product_id" => $products[$i],
                "amount" => $amounts[$i],
                "discount_price" => $discount_prices[$i],
                "total" => $totals[$i],
                "return_order_id" => $returnorder->id,              
            ];
          }
        }
        ReturnOrderDetail::insert($details);

        //GAURD STOCK UPDATE
        foreach($details as $item){
            if($item['amount'] == 0){
                continue;
            }
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $returnorder->code,
                "type" => "purchase_return_order",
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
        $returnorder = ReturnOrder::findOrFail($id);
        $returnorderdetail = $returnorder->return_order_details()->get();
        $mode = "show";

        return view('purchase.return-order.edit', compact('returnorder','returnorderdetail','mode'));
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
        $returnorder = ReturnOrder::findOrFail($id);
        $returnorderdetail = $returnorder->return_order_details()->get();
        $mode = "edit";
        

        return view('purchase.return-order.edit', compact('returnorder','returnorderdetail','mode'));
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
        //LOAD OLD DATA
        $new_returnorder = ReturnOrder::create($requestData);              

        //UPDATE SOME DATA
        $returnorder = ReturnOrder::findOrFail($id);
        $returnorder->purchase_status_id = -1; //VOID
        $returnorder->save();

        //DUPLICATE OBJECT
        $revision = $returnorder->revision + 1;
        $segments = explode("-",$returnorder->code);
        $code = $segments[0]."-".$segments[1]."-R".$revision; 
        // $returnorder->update($requestData);
        $new_returnorder->update([
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'code' => $code,
            'revision' => $revision,
        ]);

        //ROLLBACK Gaurd stock 
        $details = $returnorder->details()->get();
        foreach($details as $item){
            if($item['amount'] == 0){
                continue;
            }
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $returnorder->code,
                "type" => "purchase_return_order",
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

        //DELAY FOR TIMESTAMP
        sleep(1);

        //SAVE DETAIL + GAURD STOCK
        $this->store_detail($request, $new_returnorder);

        return redirect('purchase/return-order/'.$new_returnorder->id)->with('flash_message', 'ReturnOrder updated!');
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
        ReturnOrder::destroy($id);

        return redirect('purchase/return-order')->with('flash_message', 'ReturnOrder deleted!');
    }
}
