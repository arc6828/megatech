<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
  public function index($customer_id,$type,$filename)
  {
    //return "HELLO";
    return response()->file(storage_path("app/public/{$customer_id}/{$type}/{$filename}"));
  }
}
