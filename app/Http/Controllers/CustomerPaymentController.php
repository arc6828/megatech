<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerPayment;
use App\CustomerBilling;
use App\CustomerModel;
use App\Sales\InvoiceModel;
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
        if( request('filter')=="billing-only"){
            //วางบิลแล้วเท่านั้น 12
            $invoices = InvoiceModel::where('sales_status_id',12)->where('customer_id',$customer_id)->get();
   
        }else{
            //ที่ยอดมีหนี้ทั้งหมด
            $invoices = InvoiceModel::where('total_debt','>',0)->where('customer_id',$customer_id)->get();
                   
        }
            

             
        /*$customer_billings = CustomerBilling::where('customer_billing_id', $customer_billing_id)
            ->where('total_debt','>',0)
            ->get();
            */

            
        $bank_accounts = BankAccount::all();

        return view('customer-payment.create', compact('invoices','customer','bank_accounts') );
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
        
        CustomerPayment::create($requestData);

        //UPDATE INVOICE 
        if (is_array ($requestData['invoice_payments'])){
            for( $i=0; $i<count($requestData['invoice_payments']); $i++ ){
                $invoice_payment = $requestData['invoice_payments'][$i];
                $invoice_id = $requestData['invoice_ids'][$i];
                $invoice = InvoiceModel::find($invoice_id);
                if($invoice){
                    //ADD UP
                    $invoice->total_payment = $invoice->total_payment + $invoice_payment;
                    $invoice->total_debt = $invoice->total_debt - $invoice_payment;
                    $invoice->save();
                }
            }
        }

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
                    ]);

                    //INSERT CHEQUE IF EXIST
                    if( $requestData['transaction_code'][$i] == "deposite-cheque" ){
                          /*                  
                    
                        Cheque::create([
                            'cheque_date' => $requestData['date'][$i] ,
                            'total' => $requestData['total_cheque'] ,
                        ]);*/
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
