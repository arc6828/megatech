<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductModel;
class InventoryController extends Controller
{
    public function screen_3_2(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_3_2',compact('Product'));
    }

    public function screen_3_6(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_3_6',compact('Product'));
    }

    public function screen_3_13(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_3_13',compact('Product'));
    }

    public function screen_4_4(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_4_4',compact('Product'));
    }
    public function screen_1_1(){
        $Product = ProductModel::all();
        return view('report.inventory.screen_1_1',compact('Product'));
    }
    public function screen_2_1(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_2_1',compact('Product'));
    }
    public function screen_2_6(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_2_6',compact('Product'));
    }
    public function screen_2_9(){
        $Product = ProductModel::where('product_code', 'KKTJY18011')->get();
        return view('report.inventory.screen_2_9',compact('Product'));
    }
}
