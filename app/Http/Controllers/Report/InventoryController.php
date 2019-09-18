<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function screen_3_2(){
        return view('report.inventory.screen_3_2');
    }

    public function screen_3_6(){
        return view('report.inventory.screen_3_6');
    }

    public function screen_3_13(){
        return view('report.inventory.screen_3_13');
    }

    public function screen_4_4(){
        return view('report.inventory.screen_4_4');
    }
}
