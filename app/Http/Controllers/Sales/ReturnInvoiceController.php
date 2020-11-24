<?php

namespace App\Http\Controllers\Sales;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sales\ReturnInvoice;
use App\Sales\ReturnInvoiceDetail;
use App\Sales\InvoiceModel;
use App\ProductModel;
use App\GaurdStock;

use Illuminate\Http\Request;

class ReturnInvoiceController extends Controller
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
        //     $returninvoice = ReturnInvoice::where('code', 'LIKE', "%$keyword%")
        //         ->orWhere('customer_id', 'LIKE', "%$keyword%")
        //         ->orWhere('invoice_code', 'LIKE', "%$keyword%")
        //         ->orWhere('tax_type_id', 'LIKE', "%$keyword%")
        //         ->orWhere('sales_status_id', 'LIKE', "%$keyword%")
        //         ->orWhere('user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('remark', 'LIKE', "%$keyword%")
        //         ->orWhere('total_before_vat', 'LIKE', "%$keyword%")
        //         ->orWhere('vat', 'LIKE', "%$keyword%")
        //         ->orWhere('vat_percent', 'LIKE', "%$keyword%")
        //         ->orWhere('total_after_vat', 'LIKE', "%$keyword%")
        //         ->orWhere('revision', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $returninvoice = ReturnInvoice::latest()->paginate($perPage);
        // }
        $returninvoice = ReturnInvoice::latest()->get();

        return view('sales.return-invoice.index', compact('returninvoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {

        $keyword = $request->get('search');
        $returninvoice = InvoiceModel::firstOrNew(['invoice_code'=> $keyword]);
        $returninvoice->total_before_vat = 0;
        $returninvoice->total_after_vat = 0;
        $returninvoice->vat = 0;
        //$returninvoice->sales_status_id = 0;
        $returninvoicedetail = isset($returninvoice) ? $returninvoice->invoice_details()->get() : [];

        return view('sales.return-invoice.create',compact('returninvoice','returninvoicedetail'));
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
        $returninvoice = ReturnInvoice::create($requestData);

        $this->store_detail($request, $returninvoice);

        return redirect('sales/return-invoice/'.$returninvoice->id)->with('flash_message', 'ReturnInvoice added!');
    }

    public function getNewCode(){
        $number = ReturnInvoice::where('sales_status_id','!=','-1')
            ->whereMonth('created_at',date("m"))
            ->whereYear('created_at',date("Y"))
            ->count();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "RI{$year}{$month}-{$number}";
        return $code;
    }

    public function store_detail(Request $request, $returninvoice){
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
                "return_invoice_id" => $returninvoice->id,              
            ];
          }
        }
        ReturnInvoiceDetail::insert($details);

        //GAURD STOCK UPDATE        
        foreach($details as $item){
            if($item['amount'] == 0){
                continue;
            }
            $product = ProductModel::findOrFail($item['product_id']);
            $gaurd_stock = GaurdStock::create([
                "code" => $returninvoice->code,
                "type" => "sales_return_invoice",
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
        $returninvoice = ReturnInvoice::findOrFail($id);
        
        $returninvoicedetail = $returninvoice->return_invoice_details()->get();
        $mode = "show";
        return view('sales.return-invoice.edit',compact('returninvoice','returninvoicedetail','mode'));

        // return view('sales.return-invoice.show', compact('returninvoice'));
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
        $returninvoice = ReturnInvoice::findOrFail($id);

        // $keyword = $request->get('search');
        // $returninvoice = InvoiceModel::firstOrNew(['invoice_code'=> $keyword]);
        // $returninvoice->total_before_vat = 0;
        // $returninvoice->total_after_vat = 0;
        // $returninvoice->vat = 0;
        //$returninvoice->sales_status_id = 0;
        $returninvoicedetail = $returninvoice->return_invoice_details()->get();
        $mode = "edit";

        return view('sales.return-invoice.edit',compact('returninvoice','returninvoicedetail','mode'));

        // return view('sales.return-invoice.edit', compact('returninvoice'));
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
        $new_returninvoice = ReturnInvoice::create($requestData);              

        //UPDATE SOME DATA
        $returninvoice = ReturnInvoice::findOrFail($id);
        $returninvoice->sales_status_id = -1; //VOID
        $returninvoice->save();

        //DUPLICATE OBJECT
        $revision = $returninvoice->revision + 1;
        $segments = explode("-",$returninvoice->code);
        $code = $segments[0]."-".$segments[1]."-R".$revision; 
        //$returninvoice->update($requestData);
        $new_returninvoice->update([
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'code' => $code,
            'revision' => $revision,
        ]);

        //ROLLBACK Gaurd stock 
        $details = $returninvoice->details()->get();
        foreach($details as $item){
            $product = ProductModel::findOrFail($item->product_id);
            $gaurd_stock = GaurdStock::create([
                "code" => $returninvoice->code,
                "type" => "sales_return_invoice_cancel",
                "amount" => $item->amount,
                "amount_in_stock" => ($product->amount_in_stock - $item->amount),
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
        $this->store_detail($request, $new_returninvoice);

        return redirect('sales/return-invoice/'.$new_returninvoice->id)->with('flash_message', 'ReturnInvoice updated!');
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
        ReturnInvoice::destroy($id);

        return redirect('sales/return-invoice')->with('flash_message', 'ReturnInvoice deleted!');
    }
}
