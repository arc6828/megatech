<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Purchase\ReceiveModel;
use App\SupplierBillingDetail;
use App\SupplierModel;
use App\SupplierBilling;
use Illuminate\Http\Request;
use PDF;

class SupplierBillingController extends Controller
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
            $supplierbilling = SupplierBilling::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('supplier_id', 'LIKE', "%$keyword%")
                ->orWhere('condition_billing', 'LIKE', "%$keyword%")
                ->orWhere('condition_cheque', 'LIKE', "%$keyword%")
                ->orWhere('date_billing', 'LIKE', "%$keyword%")
                ->orWhere('date_cheque', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $supplierbilling = SupplierBilling::latest()->paginate($perPage);
        }

        return view('supplier-billing.index', compact('supplierbilling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $end_date = !empty( $request->get('end_date') ) ? request('end_date') : date('Y-m-d');
        $supplier_id = request('supplier_id',0);
        $supplier = SupplierModel::find($supplier_id);
        $table_receive = ReceiveModel::where('supplier_id', $supplier_id)
            ->where('datetime','<=', $end_date )
            ->where('purchase_status_id','<',12) //purchase_status_id 12 : วางบิลแล้ว
            ->where('total_debt','>',0)
            ->get();
        return view('supplier-billing.create', compact('table_receive','supplier') );
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
        //CREATE SupplierBillingDetail
        $requestData = $request->all();
        $requestData['doc_no'] = $this->getNewCode("BA");
        $supplier_billing = SupplierBilling::create($requestData);

        

        //CREATE SupplierBillingDetail        
        $end_date = !empty( $request->get('end_date') ) ? request('end_date') : date('Y-m-d');
        $supplier_id = $requestData['supplier_id'];
        $supplier = SupplierModel::find($supplier_id);
        $table_receive = ReceiveModel::where('supplier_id', $supplier_id)        
            ->where('datetime','<=', $end_date )
            ->where('purchase_status_id','<',12) //purchase_status_id 12 : วางบิลแล้ว
            ->where('total_debt','>',0)
            ->get();
        foreach($table_receive as $item){
            $supplier_billing_detail = new SupplierBillingDetail;
            $supplier_billing_detail->doc_id = $item->receive_id;            
            $supplier_billing_detail->supplier_billing_id = $supplier_billing->id;
            $supplier_billing_detail->save();

            $item->purchase_status_id = 12; //purchase_status_id 12 : วางบิลแล้ว
            $item->save();
        }     

        return redirect('/finance/supplier-billing')->with('flash_message', 'SupplierBilling added!');
    }

    public function getNewCode($code){
        //COUNT BY CURRENT MONTH
        $number = SupplierBilling::whereRaw('month(created_at) = month(now()) and year(created_at) = year(now())', [])->count();
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
        $supplierbilling = SupplierBilling::findOrFail($id);

        return view('supplier-billing.show', compact('supplierbilling'));
    }
    public function pdf($id)
    {
        $supplierbilling = SupplierBilling::findOrFail($id);        

        //return view('supplier-billing.show', compact('supplierbilling'));

        return  PDF::loadView('supplier-billing/pdf', compact('supplierbilling'))->stream('test.pdf');
        
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
        $supplierbilling = SupplierBilling::findOrFail($id);

        return view('supplier-billing.edit', compact('supplierbilling'));
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
        
        $supplierbilling = SupplierBilling::findOrFail($id);
        $supplierbilling->update($requestData);

        return redirect('/finance/supplier-billing')->with('flash_message', 'SupplierBilling updated!');
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
        SupplierBilling::destroy($id);

        return redirect('/finance/supplier-billing')->with('flash_message', 'SupplierBilling deleted!');
    }
}
