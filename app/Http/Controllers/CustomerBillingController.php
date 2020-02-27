<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sales\InvoiceModel;
use App\Checklist;
use App\CustomerBillingDetail;
use App\CustomerModel;
use App\CustomerBilling;
use Illuminate\Http\Request;
use App\Functions;
use PDF;

class CustomerBillingController extends Controller
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
            $customerbilling = CustomerBilling::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('condition_billing', 'LIKE', "%$keyword%")
                ->orWhere('condition_cheque', 'LIKE', "%$keyword%")
                ->orWhere('date_billing', 'LIKE', "%$keyword%")
                ->orWhere('date_cheque', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customerbilling = CustomerBilling::latest()->paginate($perPage);
        }

        return view('customer-billing.index', compact('customerbilling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $end_date = !empty( $request->get('end_date') ) ? request('end_date') : date('Y-m-d');
        $customer_id = request('customer_id',0);
        $customer = CustomerModel::find($customer_id);
        $customers = CustomerModel::all();
        if($customer){
            Checklist::firstOrCreate(
                ['customer_id' => $customer->customer_id],
                ['type' => 'customer']
            );
        }
        
        $table_invoice = InvoiceModel::where('customer_id', $customer_id)
            ->where('datetime','<=', $end_date )
            ->where('sales_status_id','<',12) //sales_status_id 12 : วางบิลแล้ว
            ->where('total_debt','>',0)
            ->get();
        return view('customer-billing.create', compact('table_invoice','customer','customers') );
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
        //CREATE CustomerBillingDetail
        $requestData = $request->all();
        $requestData['doc_no'] = $this->getNewCode("BI");
        $customer_billing = CustomerBilling::create($requestData);

        

        //CREATE CustomerBillingDetail        
        $end_date = !empty( $request->get('end_date') ) ? request('end_date') : date('Y-m-d');
        $customer_id = $requestData['customer_id'];
        $customer = CustomerModel::find($customer_id);
        $table_invoice = InvoiceModel::where('customer_id', $customer_id)        
            ->where('datetime','<=', $end_date )
            ->where('sales_status_id','<',12) //sales_status_id 12 : วางบิลแล้ว
            ->where('total_debt','>',0)
            ->get();
        foreach($table_invoice as $item){
            $customer_billing_detail = new CustomerBillingDetail;
            $customer_billing_detail->doc_id = $item->invoice_id;            
            $customer_billing_detail->customer_billing_id = $customer_billing->id;
            $customer_billing_detail->save();

            $item->sales_status_id = 12; //sales_status_id 12 : วางบิลแล้ว
            $item->save();
        }     

        return redirect('/finance/customer-billing')->with('flash_message', 'CustomerBilling added!');
    }

    public function getNewCode($code){
        //COUNT BY CURRENT MONTH
        $number = CustomerBilling::whereRaw('month(created_at) = month(now()) and year(created_at) = year(now())', [])->count();
        $count =  $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "{$code}{$year}{$month}-{$number}";
        return $code;
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
        $customerbilling = CustomerBilling::findOrFail($id);

        return view('customer-billing.show', compact('customerbilling'));
    }
    public function pdf($id)
    {
        $customerbilling = CustomerBilling::findOrFail($id);   
        
        $total_text = $customerbilling->total > 0  ?  Functions::baht_text($customerbilling->total) : "-";     

        //return view('customer-billing.show', compact('customerbilling'));

        return  PDF::loadView('customer-billing/pdf', compact('customerbilling','total_text'))->stream('test.pdf');
        
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
        $customerbilling = CustomerBilling::findOrFail($id);

        return view('customer-billing.edit', compact('customerbilling'));
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
        
        $customerbilling = CustomerBilling::findOrFail($id);
        $customerbilling->update($requestData);

        return redirect('/finance/customer-billing')->with('flash_message', 'CustomerBilling updated!');
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
        CustomerBilling::destroy($id);

        return redirect('/finance/customer-billing')->with('flash_message', 'CustomerBilling deleted!');
    }
}
