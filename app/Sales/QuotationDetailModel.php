<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationDetailModel extends Model
{
    public static function select_all(){
		return DB::table('tb_quotation_detail')
            ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
            ->get();
	}

	public static function select_by_quotation_id($quotation_id){
        return DB::table('tb_quotation_detail')
            ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
            ->where('quotation_id', '=' , $quotation_id )
            ->get();
	}

	public static function select_by_id($id){
        return DB::table('tb_quotation_detail')
            ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
            ->where('quotation_detail_id', '=' , $id )
            ->get();
	}

    public static function insert($input){
        return DB::table('tb_quotation_detail')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_quotation_detail')
            ->where('quotation_detail_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_quotation_detail')
            ->where('quotation_detail_id', '=', $id)
            ->delete();
	}
}
