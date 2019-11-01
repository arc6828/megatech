<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerModel;


class CustomerController extends Controller
{
    public function screen_1_3()
    {
      $customer = CustomerModel::all();
      return view('report/customer/screen_1_3',compact('customer'));
   
    }
    public function screen_1_5()
    {
      $customer = CustomerModel::all();
      return view('report/customer/screen_1_5',compact('customer'));
    
    }
    
    public function screen_2_3()
    {
      $customer = CustomerModel::all();
      return view('report/customer/screen_2_3',compact('customer'));
     
    }
    public function screen_4_1()
    {
      return view('report/customer/screen_4_1');
    
    }
    public function screen_3_2()
    {
      $customer = CustomerModel::all();
      return view('report/customer/screen_3_2',compact('customer'));
      
    
    }
    public function screen_5_8()
    {
      return view('report/customer/screen_5_8');
    
    }
    public function screen_5_9()
    {
      return view('report/customer/screen_5_9');
    
    }
    public function screen_6_15()
    {
      return view('report/customer/screen_6_15');
    
    }
    public function screen_7_8()
    {
      return view('report/customer/screen_7_8');
    
    }
}
