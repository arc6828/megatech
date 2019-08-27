<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
  public function index($blob,$id,$type,$filename)
  {
    //return "HELLO";
    return response()->file(storage_path("app/public/{$blob}/{$id}/{$type}/{$filename}"));
  }
}
