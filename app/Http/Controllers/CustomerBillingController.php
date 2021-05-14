<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\CustomerBilling;
use App\CustomerBillingDetail;
use App\CustomerModel;
use App\Functions;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Numberun;
use App\Sales\InvoiceModel;
use Illuminate\Http\Request;
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
        // $keyword = $request->get('search');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     $customerbilling = CustomerBilling::where('doc_no', 'LIKE', "%$keyword%")
        //         ->orWhere('total', 'LIKE', "%$keyword%")
        //         ->orWhere('customer_id', 'LIKE', "%$keyword%")
        //         ->orWhere('condition_billing', 'LIKE', "%$keyword%")
        //         ->orWhere('condition_cheque', 'LIKE', "%$keyword%")
        //         ->orWhere('date_billing', 'LIKE', "%$keyword%")
        //         ->orWhere('date_cheque', 'LIKE', "%$keyword%")
        //         ->orWhere('remark', 'LIKE', "%$keyword%")
        //         ->orWhere('user_id', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $customerbilling = CustomerBilling::latest()->paginate($perPage);
        // }
        $customerbilling = CustomerBilling::latest()->get();

        return view('customer-billing.index', compact('customerbilling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $end_date = !empty($request->get('end_date')) ? request('end_date') : date('Y-m-d');
        $customer_id = request('customer_id', 0);
        $customer = CustomerModel::find($customer_id);
        $customers = CustomerModel::all();
        if ($customer) {
            Checklist::firstOrCreate(
                ['customer_id' => $customer->customer_id],
                ['type' => 'customer']
            );
        }

        $table_invoice = InvoiceModel::where('customer_id', $customer_id)
            ->where('datetime', '<=', $end_date)
            ->where('sales_status_id', '<', 12) //sales_status_id 12 : วางบิลแล้ว
            ->where('total_debt', '>', 0)
            ->get();
        return view('customer-billing.create', compact('table_invoice', 'customer', 'customers'));
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
        $requestData['doc_no'] = $this->getNewCode();
        $customer_billing = CustomerBilling::create($requestData);

        //MAKE a whitelist (checkbox)
        $whitelist = $request->input('checkboxs');

        //CREATE CustomerBillingDetail
        $end_date = !empty($request->get('end_date')) ? request('end_date') : date('Y-m-d');
        $customer_id = $requestData['customer_id'];
        $customer = CustomerModel::find($customer_id);
        $table_invoice = InvoiceModel::where('customer_id', $customer_id)
            ->where('datetime', '<=', $end_date)
            ->where('sales_status_id', '<', 12) //sales_status_id 12 : วางบิลแล้ว
            ->where('total_debt', '>', 0)
            ->get();
        foreach ($table_invoice as $item) {
            $customer_billing_detail = new CustomerBillingDetail;
            $customer_billing_detail->doc_id = $item->invoice_id;
            $customer_billing_detail->customer_billing_id = $customer_billing->id;
            $customer_billing_detail->code = $item->invoice_code;
            $customer_billing_detail->total_debt = $item->total_debt;
            //CHECK IF NOT IN WHITELIST -> SKIP
            if (!in_array($item->invoice_code, $whitelist)) {
                continue;
            }
            $customer_billing_detail->save();

            $item->sales_status_id = 12; //sales_status_id 12 : วางบิลแล้ว
            $item->save();
        }

        return redirect('/finance/customer-billing')->with('flash_message', 'CustomerBilling added!');
    }

    public function getNewCode()
    {
        //COUNT BY CURRENT MONTH
        $number = CustomerBilling::whereRaw('month(created_at) = month(now()) and year(created_at) = year(now())', [])->count();
        $run_number = Numberun::where('id', '11')->value('number_en');

        $count = $number + 1;
        //$year = (date("Y") + 543) % 100;
        $year = date("y");
        $month = date("m");
        $number = sprintf('%05d', $count);
        $code = "{$run_number}{$year}{$month}-{$number}";
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
        $customer = CustomerModel::find($customerbilling->customer_id);

        return view('customer-billing.show', compact('customerbilling', 'customer'));
    }
    public function pdf($id)
    {
        $customerbilling = CustomerBilling::findOrFail($id);
        $customer_billing_detail = CustomerBillingDetail::join('tb_invoice', 'tb_invoice.invoice_id', '=', 'customer_billing_details.doc_id')->firstOrFail();
        $table_company = Company::select_all();
        $total_text = $customerbilling->total > 0 ? Functions::baht_text($customerbilling->total) : "-";
        $data = [
            'customerbilling' => $customerbilling,
            'customer_billing_detail' => $customer_billing_detail,
            'total_text' => $total_text,
            'company' => $table_company,
        ];
        //return view('customer-billing.show', compact('customerbilling'));
        // print_r($data['customer_billing_detail']);
        $pdf = PDF::loadView('customer-billing/pdf', $data);
        return $pdf->stream('ใบวางบิล.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $customerbilling = CustomerBilling::findOrFail($id);
        $end_date = !empty($request->get('end_date')) ? request('end_date') : date('Y-m-d');
        $customer_id = request('customer_id', 0);
        $customer = CustomerModel::find($customer_id);
        $customers = CustomerModel::all();
        if ($customer) {
            Checklist::firstOrCreate(
                ['customer_id' => $customer->customer_id],
                ['type' => 'customer']
            );
        }

        $table_invoice = InvoiceModel::where('customer_id', $customer_id)
            ->where('datetime', '<=', $end_date)
            ->where('sales_status_id', '<', 12) //sales_status_id 12 : วางบิลแล้ว
            ->where('total_debt', '>', 0)
            ->get();
        // $table_invoice = InvoiceModel::findOrFail($id);
        return view('customer-billing.edit', compact('customerbilling', 'table_invoice', 'customer', 'customers'));
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
