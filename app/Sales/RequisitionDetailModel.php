<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisitionDetailModel extends Model
{
    public static function select_all(){
		return DB::table('tb_requisition_detail')
            ->join('tb_product','tb_requisition_detail.product_id','=','tb_product.product_id')
            ->get();
	}

	public static function select_by_requisition_id($requisition_id){
        return DB::table('tb_requisition_detail')
            ->join('tb_product','tb_requisition_detail.product_id','=','tb_product.product_id')
            ->where('requisition_id', '=' , $requisition_id )
            ->get();
	}

	public static function select_by_id($id){
        return DB::table('tb_requisition_detail')
            ->join('tb_product','tb_requisition_detail.product_id','=','tb_product.product_id')
            ->where('requisition_detail_id', '=' , $id )
            ->get();
	}

    public static function insert($input){
        return DB::table('tb_requisition_detail')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_requisition_detail')
            ->where('requisition_detail_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_requisition_detail')
            ->where('requisition_detail_id', '=', $id)
            ->delete();
	}
}