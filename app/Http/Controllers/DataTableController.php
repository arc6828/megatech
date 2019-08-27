<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerModel;

class DataTableController extends Controller
{
    public function getCustomers(){
      $table_customer = CustomerModel::select_all();
      return response()->json($table_customer);
    }
}
