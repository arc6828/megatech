<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseStatusModel extends Model
{
  public static function select_all(){
    return DB::table('tb_purchase_status')->get();
	}

  public static function select_by_category($category){
    return DB::table('tb_purchase_status')
      ->where('category',$category)
      ->get();
	}
}
