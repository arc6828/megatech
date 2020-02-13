<?php

namespace App\Http\Controllers\Report;
use App\User;
use App\Sales\InvoiceDetailModel;
use App\CustomerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserModel;
use App\ProductModel;
use App\Sales\QuotationModel;
use App\Sales\QuotationDetailModel;
use PDF;
class SalesController extends Controller
{
    public function screen_1_3(){          
        $customer = CustomerModel::all();
        //$pdf = PDF::loadView('report.sales.screen_1_3',compact('customer'));
        //return $pdf->stream('report.sales.screen_1_3.pdf');
        return view('report.sales.screen_1_3',compact('customer'));
    }

    public function screen_1_5(){
        $users = User::all();
        return view('report.sales.screen_1_5',compact('users'));
    }

    public function screen_1_12(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_1_12',compact('customer'));
    }

    public function screen_1_15(){
        $users = User::all();
        return view('report.sales.screen_1_15',compact('users'));
    }

    public function screen_1_16(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_1_16',compact('customer'));
    }

    public function screen_1_18(){
        $products = ProductModel::join('tb_invoice_detail', 'tb_product.product_id', '=', 'tb_invoice_detail.product_id')->get();
        return view('report.sales.screen_1_18',compact('products'));
    }

    public function screen_1_19(){
        $users = User::all();
        return view('report.sales.screen_1_19',compact('users'));
    }

    public function screen_1_21(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_1_21',compact('customer'));
    }

     public function screen_6_4(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.sales.screen_6_4',compact('Product'));
    }

     public function screen_6_5(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_6_5',compact('customer'));
    }
    public function screen_3_17(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_3_17',compact('customer'));
    }
    public function screen_3_26(){
        $users = User::all();
        return view('report.sales.screen_3_26',compact('users'));
    }
    public function screen_3_21(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_3_21',compact('customer'));
    }
      public function screen_6_6(){
        $users = User::all();
        return view('report.sales.screen_6_6',compact('users'));
    }

     public function screen_2_3(){
        $customer = CustomerModel::all();
        return view('report.sales.screen_2_3',compact('customer'));
    }

    public function screen_3_11(){
        $Product = ProductModel::all();
        return view('report.sales.screen_3_11',compact('Product'));
    }

    public function screen_4_1(){
        return view('report.sales.screen_4_1');
    }

    public function screen_5_x(){
        $QuotationDetail = QuotationDetailModel::all();
        return view('report.sales.screen_5_x',compact('QuotationDetail'));
    }

}
