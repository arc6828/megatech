<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    protected $table = "tb_product";

    public static function select_all(){
        return DB::table('tb_product')
            ->get();
	  }

    public static function select_by_keyword($q){
        return DB::table('tb_product')
            ->where('product_name', 'like' , "%{$q}%" )
            ->orWhere('item_code', 'like' , "%{$q}%" )
            ->limit(100)
            ->get();
     }
    public static function select_by_id($id) {
        return DB::table('tb_product')
            ->where('product_id', '=', $id)
            ->get();
    }
    public static function insert($input){
        return DB::table('tb_product')->insertGetId($input);
    }
    public static function update_by_id($input,$id) {
        DB::table('tb_product')
        ->where('product_id', $id)
        ->update($input);
    }
    public static function delete_by_id($id){
		DB::table('tb_product')
            ->where('product_id', '=', $id)
            ->delete();
	}
}
