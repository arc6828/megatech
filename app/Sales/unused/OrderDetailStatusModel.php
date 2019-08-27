<?php

namespace App\Sales\unused;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetailStatusModel extends Model
{
  public static function select_all(){
    return DB::table('tb_order_detail_status')
          ->get();
  }
}
