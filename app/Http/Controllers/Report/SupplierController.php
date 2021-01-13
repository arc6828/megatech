<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SupplierModel;

class SupplierController extends Controller
{
    public function screen_1_4()
    {
      //supplier เป็น array แนะนำให้ตั้งชื่อเป็นพหูพจน์
      $suppliers=SupplierModel::all();
      return view ("report/supplier/screen_1_4",compact('suppliers'));
    }
    public function screen_1_5()
    {
      //supplier เป็น array แนะนำให้ตั้งชื่อเป็นพหูพจน์
      $suppliers=SupplierModel::all();
      return view("report/supplier/screen_1_5",compact('suppliers'));
    }
    public function screen_2_2()
    {
      $suppliers=SupplierModel::all();
      return view("report/supplier/screen_2_2",compact('suppliers'));
    }
    public function screen_3_2()
    {
      $suppliers=SupplierModel::all();
      return view("report/supplier/screen_3_2",compact('suppliers'));
    }
    public function screen_4_1()
    {
      return view("report/supplier/screen_4_1");
    }
    public function screen_5_2()
    {
      $suppliers=SupplierModel::all();
      return view("report/supplier/screen_5_2",compact('suppliers'));
    }
    public function screen_6_16()
    {
      $suppliers=SupplierModel::all();
      return view("report/supplier/screen_6_16",compact('suppliers'));
    }
    public function screen_7_2()
    {
      $suppliers=SupplierModel::all();
      return view("report/supplier/screen_7_2",compact('suppliers'));
    }
}
