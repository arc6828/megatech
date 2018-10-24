<?php

namespace App\Sales;

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

class RequisitionModel extends Model
{
    public static function select_all(){
		$total_query = DB::table('tb_requisition_detail')
            ->select( DB::raw('requisition_id, sum(discount_price) as total'))
            ->groupBy('requisition_id');
        return DB::table('tb_requisition')
            ->join('tb_customer', 'tb_requisition.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_requisition.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_requisition.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_requisition.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_requisition.user_id', '=', 'users.id')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_requisition.requisition_id', '=', 'total_query.requisition_id');
			})
			->select( DB::raw(
				'tb_requisition.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_requisition` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_requisition')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            //->where('month(datetime)', 'month(now())')
            //->where('year(datetime)', 'year(now())')
            ->count();
	}

	public static function select_by_id($id){
		$total_query = DB::table('tb_requisition_detail')
             ->select( DB::raw('requisition_id, sum(discount_price) as total'))
             ->groupBy('requisition_id');
        return DB::table('tb_requisition')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_requisition.requisition_id', '=', 'total_query.requisition_id');
			})
            ->where('tb_requisition.requisition_id', '=' , $id )
			->select( DB::raw(
				'tb_requisition.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function select_by_keyword($q){
      //SELECT * FROM `tb_requisition`
      //Left JOIN ( SELECT sum(discount_price) as total_discount_price , requisition_id FROM `tb_requisition_detail` GROUP BY requisition_id ) q
      //on `tb_requisition`.`requisition_id` = q.requisition_id

        $total_query = DB::table('tb_requisition_detail')
             ->select( DB::raw('requisition_id, sum(discount_price) as total'))
             ->groupBy('requisition_id');
        return DB::table('tb_requisition')
            ->join('tb_customer', 'tb_requisition.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_requisition.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_requisition.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_requisition.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_requisition.user_id', '=', 'users.id')
            ->leftJoinSub($total_query, 'total_query', function($join) {
                $join->on('tb_requisition.requisition_id', '=', 'total_query.requisition_id');
            })
            ->where('requisition_code', 'like' , "%{$q}%" )
            ->orWhere('company_name', 'like' , "%{$q}%" )
            ->orWhere('customer_name', 'like' , "%{$q}%" )
            ->orWhere('sales_status_name', 'like' , "%{$q}%" )
			->select( DB::raw(
				'tb_requisition.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function insert($input){
        return DB::table('tb_requisition')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_requisition')
            ->where('requisition_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
        DB::table('tb_requisition')
            ->where('requisition_id', '=', $id)
            ->delete();
	}

	public static function select_customer($q) {
		$sql = "select tb_requisition.id, tb_requisition.id_dept, tb_requisition.date_dept, tb_requisition.total, tb_requisition.id_customer, customer.name_company
			from tb_requisition inner join customer on tb_requisition.id_customer = customer.id_customer
			where tb_requisition.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
