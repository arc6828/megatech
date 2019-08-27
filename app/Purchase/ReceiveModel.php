<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiveModel extends Model
{
    public static function select_all(){
      return DB::table('tb_purchase_receive')
          ->join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
          ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
          ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
          ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
          ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
          ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_purchase_receive` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_purchase_receive')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_receive')
      ->join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_purchase_receive.purchase_receive_id', '=' , $id )
			->select( DB::raw('tb_purchase_receive.*, tb_supplier.company_name, tb_supplier.supplier_code'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_purchase_receive')
      ->join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_purchase_receive.*, tb_supplier.contact_name'
        ))
      ->get();
	}

	public static function insert($input){
    return DB::table('tb_purchase_receive')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_receive')
        ->where('purchase_receive_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
    DB::table('tb_purchase_receive')
        ->where('purchase_receive_id', '=', $id)
        ->delete();
	}

}
