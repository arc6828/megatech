<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderModel extends Model
{
    public static function select_all(){
      return DB::table('tb_purchase_order')
          ->join('tb_customer', 'tb_purchase_order.customer_id', '=', 'tb_customer.customer_id')
          ->join('tb_delivery_type', 'tb_purchase_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
          ->join('tb_tax_type', 'tb_purchase_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
          ->join('tb_sales_status', 'tb_purchase_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
          ->join('users', 'tb_purchase_order.user_id', '=', 'users.id')
          ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_purchase_order` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_purchase_order')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_order')
      ->join('tb_customer', 'tb_purchase_order.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_purchase_order.purchase_order_id', '=' , $id )
			->select( DB::raw('tb_purchase_order.*, tb_customer.contact_name'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_purchase_order')
      ->join('tb_customer', 'tb_purchase_order.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_purchase_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_purchase_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_sales_status', 'tb_purchase_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_purchase_order.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_purchase_order.*, tb_customer.contact_name'
        ))
      ->get();
	}

	public static function insert($input){
    return DB::table('tb_purchase_order')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_order')
        ->where('purchase_order_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
    DB::table('tb_purchase_order')
        ->where('purchase_order_id', '=', $id)
        ->delete();
	}

}
