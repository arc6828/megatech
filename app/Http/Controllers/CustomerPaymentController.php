<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerPayment;
use App\CustomerPaymentDetail;
use App\CustomerBilling;
use App\CustomerModel;
use App\Sales\InvoiceModel;
use App\CustomerDebt;
use App\Cheque;
use App\BankAccount;
use App\BankTransaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CustomerPaymentController extends Controller
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
            $customerpayment = CustomerPayment::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('round', 'LIKE', "%$keyword%")
                ->orWhere('customer_billing_id', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('debt_total', 'LIKE', "%$keyword%")
                ->orWhere('cash', 'LIKE', "%$keyword%")
                ->orWhere('credit', 'LIKE', "%$keyword%")
                ->orWhere('tax', 'LIKE', "%$keyword%")
                ->orWhere('payment_total', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customerpayment = CustomerPayment::latest()->paginate($perPage);
        }

        return view('customer-payment.index', compact('customerpayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        /*
        $customer_id = request('customer_id',0);
        $customer = CustomerModel::find($customer_id);
        $table_invoice = InvoiceModel::where('customer_id', $customer_id)
            ->where('total_debt','>',0)
            ->get();
        */
        $customer_id = request('customer_id',0);
        $customer = CustomerModel::find($customer_id);
        $invoices = null;
        $debts = null;
        if( request('filter')=="billing-only"){
            //วางบิลแล้วเท่านั้น 12
            $invoices = InvoiceModel::where('sales_status_id',12)->where('customer_id',$customer_id)->get();  
            $debts = []; 
        }else{
            //ที่ยอดมีหนี้ทั้งหมด
            $invoices = InvoiceModel::where('total_debt','>',0)->where('customer_id',$customer_id)->get();
            $debts = CustomerDebt::where('total_debt','>',0)->where('customer_id',$customer_id)->get();
                   
        }
            

             
        /*$customer_billings = CustomerBilling::where('customer_billing_id', $customer_billing_id)
            ->where('total_debt','>',0)
            ->get();
            */

            
        $bank_accounts = BankAccount::all();
        $customers = CustomerModel::all();

        return view('customer-payment.create', compact('invoices','customer','bank_accounts','customers','debts') );
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
        
        
        $requestData = $request->except(['transaction_code','date','bank_account_id','amount','remark']);
        $requestData['doc_no'] = $this->getNewCode("BR");

        if ($request->hasFile('payment_file')) {
            $folder = "customer-payment";
            $requestData['payment_file'] = $request->file('payment_file')->store($folder, 'public');
        }
        
        $customer_payment = CustomerPayment::create($requestData);

        
        if(isset($requestData['invoice_payments']))
        {
            //UPDATE INVOICE 
            if (is_array ($requestData['invoice_payments'])){
                for( $i=0; $i<count($requestData['invoice_payments']); $i++ ){
                    //INVOICE UPDATE
                    $invoice_payment = $requestData['invoice_payments'][$i];
                    $invoice_id = $requestData['invoice_ids'][$i];
                    $invoice = InvoiceModel::find($invoice_id);
                    //SKIP IF ZERO
                    if($invoice_payment == 0 ){
                        continue;
                    }
                    if($invoice){
                        //CREATE CUSTOMER PAYMENT
                        CustomerPaymentDetail::create([
                            'doc_id' => $invoice->invoice_id,
                            'customer_payment_id' => $customer_payment->id,
                            'code' =>  $invoice->invoice_code,
                            'total_debt' => $invoice->total_debt,
                            'total_payment' => $invoice_payment,
                            'total_remain' => $invoice->total_debt - $invoice_payment ,
                        ]);

                        //ADD UP
                        $invoice->total_payment = $invoice->total_payment + $invoice_payment;
                        $invoice->total_debt = $invoice->total_debt - $invoice_payment;
                        $invoice->customer_payment_id = $customer_payment->id;
                        $invoice->save();

                    }
                }
            }

        }
        // if(isset($requestData['customer_debt_payments']))
        // {
        //     //UPDATE customer_debt หนี้คงค้าง
        //     if (is_array ($requestData['customer_debt_payments'])){
        //         for( $i=0; $i<count($requestData['customer_debt_payments']); $i++ ){
        //             $customer_debt_payment = $requestData['customer_debt_payments'][$i];
        //             $customer_debt_id = $requestData['customer_debt_ids'][$i];
        //             $customer_debt = CustomerDebt::find($customer_debt_id);
        //             if($customer_debt){
        //                 //ADD UP
        //                 $customer_debt->total_payment = $customer_debt->total_payment + $customer_debt_payment;
        //                 $customer_debt->total_debt = $customer_debt->total_debt - $customer_debt_payment;
        //                 $customer_debt->customer_payment_id = $customer_payment->id;
        //                 $customer_debt->save();
        //             }
        //         }
        //     }
        // }
        

        //INSERT BANK-ACCOUNT
        $requestData = $request->all();
        if (is_array ($requestData['amount'])){
            for( $i=0; $i<count($requestData['amount']); $i++ ){                
                
                //INSERT
                if($requestData['amount'][$i]){
                    BankTransaction::create([
                        'transaction_code' => $requestData['transaction_code'][$i] ,
                        'date' => $requestData['date'][$i],
                        'bank_account_id' => $requestData['bank_account_id'][$i],
                        'amount' => $requestData['amount'][$i],
                        'remark' => $requestData['remark'][$i],
                        'user_id' => Auth::id() ,
                        'cheque_code' => "" ,
                        'document_code' => $customer_payment->doc_no ,
                        'code' => "" ,
                    ]);

                    //INSERT CHEQUE IF EXISTสร
                    if( $requestData['transaction_code'][$i] == "deposite-cheque" ){
                                            
                    
                        Cheque::create([                           
                            
                            'cheque_type_code' => 'cheque-in' ,
                            //'doc_no' => '' , 
                            'cheque_date' => $requestData['date'][$i] ,
                            //'cheque_type' => '' , 
                            'cheque_no' => $requestData['remark'][$i] ,
                            'total' => $requestData['amount'][$i] ,
                            //'bank_fee' => '' ,
                            'bank_account_id' => $requestData['bank_account_id'][$i] , 
                            //'passed_cheque_date' => '' , 
                            //'reference' => '' , 
                            'status' => 'pending' , 
                            'user_id' => Auth::id()
                        ]);
                    }

                }                
            }
        }

        
        
        /*
        //FOR CHEQUE -- ADD TO CHEQUE
        if( $requestData['credit'] ){
            $requestData = $request->all();
            $requestData['total'] = $requestData['total_cheque'];
            
        
            Cheque::create($requestData);
        }
        */


        return redirect('finance/customer-payment')->with('flash_message', 'CustomerPayment added!');
    }

    public function getNewCode($code){
        //COUNT BY CURRENT MONTH
        $number = CustomerPayment::whereRaw('month(created_at) = month(now()) and year(created_at) = year(now())', [])->count();
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
        $customerpayment = CustomerPayment::findOrFail($id);

        return view('customer-payment.show', compact('customerpayment'));
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
        $customerpayment = CustomerPayment::findOrFail($id);

        return view('customer-payment.edit', compact('customerpayment'));
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
        
        $customerpayment = CustomerPayment::findOrFail($id);
        $customerpayment->update($requestData);

        return redirect('customer-payment')->with('flash_message', 'CustomerPayment updated!');
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
        CustomerPayment::destroy($id);

        return redirect('customer-payment')->with('flash_message', 'CustomerPayment deleted!');
    }
}
