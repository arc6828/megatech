<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetailModel extends Model
{
    public static function select_all(){
		return DB::table('tb_order_detail')
            ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
            ->get();
	}

	public static function select_by_order_id($order_id){
        return DB::table('tb_order_detail')
            ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
            ->where('order_id', '=' , $order_id )
            ->get();
	}

	public static function select_by_id($id){
        return DB::table('tb_order_detail')
            ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
            ->where('order_detail_id', '=' , $id )
            ->get();
	}

    public static function insert($input){
        return DB::table('tb_order_detail')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_order_detail')
            ->where('order_detail_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_order_detail')
            ->where('order_detail_id', '=', $id)
            ->delete();
	}
}
