<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalesStatusModel extends Model
{
    protected $table = "tb_sales_status";
    protected $primaryKey = 'sales_status_id';
    protected $fillable = [];

    public static function select_all(){
      return DB::table('tb_sales_status')->get();
    }
    public static function select_by_category($category){
      return DB::table('tb_sales_status')
        ->where('category',$category)
        ->get();
    }
}
