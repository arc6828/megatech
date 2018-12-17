<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseRequisitionDetailModel extends Model
{
    public static function select_all(){
		return DB::table('tb_purchase_requisition_detail')
            ->join('tb_product','tb_purchase_requisition_detail.product_id','=','tb_product.product_id')
            ->get();
	}

	public static function select_by_purchase_requisition_id($purchase_requisition_id){
        return DB::table('tb_purchase_requisition_detail')
            ->join('tb_product','tb_purchase_requisition_detail.product_id','=','tb_product.product_id')
            ->where('purchase_requisition_id', '=' , $purchase_requisition_id )
            ->get();
	}

	public static function select_by_id($id){
        return DB::table('tb_purchase_requisition_detail')
            ->join('tb_product','tb_purchase_requisition_detail.product_id','=','tb_product.product_id')
            ->where('purchase_requisition_detail_id', '=' , $id )
            ->get();
	}

    public static function insert($input){
        return DB::table('tb_purchase_requisition_detail')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_purchase_requisition_detail')
            ->where('purchase_requisition_detail_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_purchase_requisition_detail')
            ->where('purchase_requisition_detail_id', '=', $id)
            ->delete();
	}
}