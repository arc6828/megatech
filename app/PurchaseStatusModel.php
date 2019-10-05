<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseStatusModel extends Model
{
    protected $table = "tb_purchase_status";
    protected $primaryKey = 'purchase_status_id';
    protected $fillable = [];

    public static function select_all(){
      return DB::table('tb_purchase_status')->get();
    }

    public static function select_by_category($category){
      return DB::table('tb_purchase_status')
        ->where('category',$category)
        ->get();
    }
}
