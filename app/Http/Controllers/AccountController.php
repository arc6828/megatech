<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountModel;

class AccountController extends Controller
{

    public function getAccount(){
        $table_account = AccountModel::select_all();
        return response()->json($table_account);
    }
}
