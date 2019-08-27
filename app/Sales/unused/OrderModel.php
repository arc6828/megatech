<?php

namespace App\Sales\unused;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/*
use App\CustomerModel;
use App\DeliveryTypeModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;
*/

class OrderModel extends Model
{
    public static function select_all(){
		$total_query = DB::table('tb_order_detail')
            ->select( DB::raw('order_id, sum(discount_price) as total'))
            ->groupBy('order_id');
        return DB::table('tb_order')
            ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_order.user_id', '=', 'users.id')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_order.order_id', '=', 'total_query.order_id');
			})
			->select( DB::raw(
				'tb_order.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_order` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_order')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            //->where('month(datetime)', 'month(now())')
            //->where('year(datetime)', 'year(now())')
            ->count();
	}

	public static function select_by_id($id){
		$total_query = DB::table('tb_order_detail')
             ->select( DB::raw('order_id, sum(discount_price) as total'))
             ->groupBy('order_id');
        return DB::table('tb_order')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_order.order_id', '=', 'total_query.order_id');
			})
            ->where('tb_order.order_id', '=' , $id )
			->select( DB::raw(
				'tb_order.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function select_by_keyword($q){
      //SELECT * FROM `tb_order`
      //Left JOIN ( SELECT sum(discount_price) as total_discount_price , order_id FROM `tb_order_detail` GROUP BY order_id ) q
      //on `tb_order`.`order_id` = q.order_id

        $total_query = DB::table('tb_order_detail')
             ->select( DB::raw('order_id, sum(discount_price) as total'))
             ->groupBy('order_id');
        return DB::table('tb_order')
            ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_order.user_id', '=', 'users.id')
            ->leftJoinSub($total_query, 'total_query', function($join) {
                $join->on('tb_order.order_id', '=', 'total_query.order_id');
            })
            ->where('order_code', 'like' , "%{$q}%" )
            ->orWhere('company_name', 'like' , "%{$q}%" )
            ->orWhere('customer_name', 'like' , "%{$q}%" )
            ->orWhere('sales_status_name', 'like' , "%{$q}%" )
			->select( DB::raw(
				'tb_order.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function insert($input){
        return DB::table('tb_order')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_order')
            ->where('order_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
        DB::table('tb_order')
            ->where('order_id', '=', $id)
            ->delete();
	}

	public static function select_customer($q) {
		$sql = "select tb_order.id, tb_order.id_dept, tb_order.date_dept, tb_order.total, tb_order.id_customer, customer.name_company
			from tb_order inner join customer on tb_order.id_customer = customer.id_customer
			where tb_order.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
