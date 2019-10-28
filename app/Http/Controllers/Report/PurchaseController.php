<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase\OrderDetailModel;
use App\SupplierModel;
use App\ProductModel;
use App\Purchase\OrderModel;
class PurchaseController extends Controller
{
    public function screen_2_2()
    {
      $Order = OrderModel::all();
      return view('report/purchase/screen_2_2',compact('Order'));
    }

    public function screen_2_3()
    {
      $OrderDetail = OrderDetailModel::all();
      return view('report/purchase/screen_2_3',compact('OrderDetail'));
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
    $OrderDetail = OrderDetailModel::all();
    return view('report/purchase/screen_1_4',compact('OrderDetail'));
}

public function screen_1_6()
  {
    $Supplier = SupplierModel::all();
    return view("report/purchase/screen_1_6",compact('Supplier'));
}

public function screen_1_8()
  {
    $Product = ProductModel::all();
    return view("report/purchase/screen_1_8",compact('Product'));
}

public function screen_1_9()
  {
    $Supplier = SupplierModel::all();
    return view("report/purchase/screen_1_9",compact('Supplier'));
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
