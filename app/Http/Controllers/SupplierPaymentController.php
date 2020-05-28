<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SupplierPayment;
use App\SupplierBilling;
use App\SupplierModel;
use App\Purchase\ReceiveModel;
use App\Cheque;
use App\BankAccount;
use App\BankTransaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class SupplierPaymentController extends Controller
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
            $supplierpayment = SupplierPayment::where('doc_no', 'LIKE', "%$keyword%")
                ->orWhere('supplier_id', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->orWhere('remark', 'LIKE', "%$keyword%")
                ->orWhere('round', 'LIKE', "%$keyword%")
                ->orWhere('supplier_billing_id', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('debt_total', 'LIKE', "%$keyword%")
                ->orWhere('cash', 'LIKE', "%$keyword%")
                ->orWhere('credit', 'LIKE', "%$keyword%")
                ->orWhere('tax', 'LIKE', "%$keyword%")
                ->orWhere('payment_total', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $supplierpayment = SupplierPayment::latest()->paginate($perPage);
        }

        return view('supplier-payment.index', compact('supplierpayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        /*
        $supplier_id = request('supplier_id',0);
        $supplier = SupplierModel::find($supplier_id);
        $table_receive = ReceiveModel::where('supplier_id', $supplier_id)
            ->where('total_debt','>',0)
            ->get();
        */
        $supplier_id = request('supplier_id',0);
        $supplier = SupplierModel::find($supplier_id);
        $receives = null;
        if( request('filter')=="billing-only"){
            //วางบิลแล้วเท่านั้น 12
            $receives = ReceiveModel::where('purchase_status_id',12)->where('supplier_id',$supplier_id)->get();
   
        }else{
            //ที่ยอดมีหนี้ทั้งหมด
            $receives = ReceiveModel::where('total_debt','>',0)->where('supplier_id',$supplier_id)->get();
                   
        }
            

             
        /*$supplier_billings = SupplierBilling::where('supplier_billing_id', $supplier_billing_id)
            ->where('total_debt','>',0)
            ->get();
            */

            
        $bank_accounts = BankAccount::all();
        $suppliers = SupplierModel::all();

        return view('supplier-payment.create', compact('receives','supplier','bank_accounts','suppliers') );
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
        
        SupplierPayment::create($requestData);

        //UPDATE RECEIVE 
        if (is_array($requestData['receive_payments'])){
            for( $i=0; $i<count($requestData['receive_payments']); $i++ ){
                $receive_payment = $requestData['receive_payments'][$i];
                $receive_id = $requestData['receive_ids'][$i];
                $receive = ReceiveModel::find($receive_id);
                if($receive){
                    //ADD UP
                    $receive->total_payment = $receive->total_payment + $receive_payment;
                    $receive->total_debt = $receive->total_debt - $receive_payment;
                    $receive->save();
                    //echo "HELLO";
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
                    if( $requestData['transaction_code'][$i] == "pay-cheque" ){
                                            
                    
                        Cheque::create([                           
                            
                            'cheque_type_code' => 'cheque-out' ,
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


        return redirect('finance/supplier-payment')->with('flash_message', 'SupplierPayment added!');
    }

    public function getNewCode($code){
        //COUNT BY CURRENT MONTH
        $number = SupplierPayment::whereRaw('month(created_at) = month(now()) and year(created_at) = year(now())', [])->count();
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
        $supplierpayment = SupplierPayment::findOrFail($id);

        return view('supplier-payment.show', compact('supplierpayment'));
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
        $supplierpayment = SupplierPayment::findOrFail($id);

        return view('supplier-payment.edit', compact('supplierpayment'));
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
        
        $supplierpayment = SupplierPayment::findOrFail($id);
        $supplierpayment->update($requestData);

        return redirect('finance/supplier-payment')->with('flash_message', 'SupplierPayment updated!');
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
        SupplierPayment::destroy($id);

        return redirect('finance/supplier-payment')->with('flash_message', 'SupplierPayment deleted!');
    }
}
