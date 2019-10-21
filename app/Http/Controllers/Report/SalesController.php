<?php

namespace App\Http\Controllers\Report;
use App\User;
use App\Sales\InvoiceDetailModel;
use App\CustomerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserModel;
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
        $InvoiceDetail = InvoiceDetailModel::all();
        return view('report.sales.screen_1_18',compact('InvoiceDetail'));
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
        return view('report.sales.screen_6_4');
    }

     public function screen_6_5(){
        return view('report.sales.screen_6_5');
    }
    public function screen_3_17(){
        return view('report.sales.screen_3_17');
    }
    public function screen_3_26(){
        return view('report.sales.screen_3_26');
    }
    public function screen_3_21(){
        return view('report.sales.screen_3_21');
    }
      public function screen_6_6(){
        return view('report.sales.screen_6_6');
    }

     public function screen_2_3(){
        return view('report.sales.screen_2_3');
    }

    public function screen_3_11(){
        return view('report.sales.screen_3_11');
    }

    public function screen_4_1(){
        return view('report.sales.screen_4_1');
    }

    public function screen_5_x(){
        return view('report.sales.screen_5_x');
    }

}
