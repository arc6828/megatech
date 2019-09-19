<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function screen_2_2()
    {
      return view('report/purchase/screen_2_2');
    }
    public function screen_2_3()
    {
      return view('report/purchase/screen_2_3');
  }
  public function screen_3_2()
    {
      return view('report/purchase/screen_3_2');
  }
  public function screen_3_3()
  {
    return view('report/purchase/screen_3_3');
}
public function screen_3_5()
  {
    return view('report/purchase/screen_3_5');
}
}
