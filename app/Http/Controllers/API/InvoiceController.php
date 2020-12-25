<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales\OrderDetailStatusModel;
use App\Sales\InvoiceDetailModel;
use App\Sales\InvoiceModel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer_id = $request->input("customer_id");

        $invoice = InvoiceModel::join('tb_customer','tb_invoice.customer_id','=','tb_customer.customer_id')
            ->where('tb_invoice.customer_id',$customer_id)
            ->where('total_debt','>',0)    
            ->get();
        
        return response()->json($invoice);
    }

    
}
