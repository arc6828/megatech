<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetailModel extends Model
{
    public static function select_all(){
		return DB::table('tb_order_detail')
        ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_order','tb_order.order_id','=','tb_order_detail.order_id')
        ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_order_detail_status', 'tb_order_detail.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();

    /*DB::table('tb_order')
            ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')

            ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
            ->get();*/
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

  public static function update_key_by_id($key, $input, $id){
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
