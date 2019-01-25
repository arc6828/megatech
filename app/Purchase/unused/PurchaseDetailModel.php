<?php

namespace App\Purchase\unused;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseDetailModel extends Model
{
    public static function select_all(){
		return DB::table('tb_purchase_receive_detail')
            ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
            ->get();
	}

	public static function select_by_purchase_receive_id($purchase_receive_id){
        return DB::table('tb_purchase_receive_detail')
            ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
            ->where('purchase_receive_id', '=' , $purchase_receive_id )
            ->get();
	}

	public static function select_by_id($id){
        return DB::table('tb_purchase_receive_detail')
            ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
            ->where('purchase_receive_detail_id', '=' , $id )
            ->get();
	}

    public static function insert($input){
        return DB::table('tb_purchase_receive_detail')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_purchase_receive_detail')
            ->where('purchase_receive_detail_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_purchase_receive_detail')
            ->where('purchase_receive_detail_id', '=', $id)
            ->delete();
	}
}
