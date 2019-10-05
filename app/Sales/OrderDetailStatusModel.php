<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetailStatusModel extends Model
{
  protected $table = "tb_order_detail_status";
  protected $primaryKey = 'order_detail_status_id';
  protected $fillable = [];
  
  public static function select_all(){
    return DB::table('tb_order_detail_status')
          ->get();
  }
}
