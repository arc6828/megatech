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

public function screen_1_4()
  {
    return view('report/purchase/screen_1_4');
}

public function screen_1_6()
  {
    return view("report/purchase/screen_1_6");
}

public function screen_1_8()
  {
    return view("report/purchase/screen_1_8");
}

public function screen_1_9()
  {
    return view("report/purchase/screen_1_9");
  }

public function screen_4_1()
  {
    return view("report/purchase/screen_4_1");
  }

public function screen_5_3()
  {
    return view("report/purchase/screen_5_3");
  }

}
