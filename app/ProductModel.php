<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    public static function select_all(){
        return DB::table('tb_product')
            ->get();
	}

    public static function select_by_keyword($q){
        return DB::table('tb_product')
            ->where('product_name', 'like' , "%{$q}%" )
            ->orWhere('product_code', 'like' , "%{$q}%" )
            ->get();
	}

    public static function insert($input){
        return DB::table('tb_product')->insertGetId($input);
	}
}
