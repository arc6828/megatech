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

class InvoiceModel extends Model
{
    public static function select_all(){
		$total_query = DB::table('tb_invoice_detail')
            ->select( DB::raw('invoice_id, sum(discount_price) as total'))
            ->groupBy('invoice_id');
        return DB::table('tb_invoice')
            ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_invoice.user_id', '=', 'users.id')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_invoice.invoice_id', '=', 'total_query.invoice_id');
			})
			->select( DB::raw(
				'tb_invoice.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_invoice` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_invoice')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            //->where('month(datetime)', 'month(now())')
            //->where('year(datetime)', 'year(now())')
            ->count();
	}

	public static function select_by_id($id){
		$total_query = DB::table('tb_invoice_detail')
             ->select( DB::raw('invoice_id, sum(discount_price) as total'))
             ->groupBy('invoice_id');
        return DB::table('tb_invoice')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_invoice.invoice_id', '=', 'total_query.invoice_id');
			})
            ->where('tb_invoice.invoice_id', '=' , $id )
			->select( DB::raw(
				'tb_invoice.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function select_by_keyword($q){
      //SELECT * FROM `tb_invoice`
      //Left JOIN ( SELECT sum(discount_price) as total_discount_price , invoice_id FROM `tb_invoice_detail` GROUP BY invoice_id ) q
      //on `tb_invoice`.`invoice_id` = q.invoice_id

        $total_query = DB::table('tb_invoice_detail')
             ->select( DB::raw('invoice_id, sum(discount_price) as total'))
             ->groupBy('invoice_id');
        return DB::table('tb_invoice')
            ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_invoice.user_id', '=', 'users.id')
            ->leftJoinSub($total_query, 'total_query', function($join) {
                $join->on('tb_invoice.invoice_id', '=', 'total_query.invoice_id');
            })
            ->where('invoice_code', 'like' , "%{$q}%" )
            ->orWhere('company_name', 'like' , "%{$q}%" )
            ->orWhere('customer_name', 'like' , "%{$q}%" )
            ->orWhere('sales_status_name', 'like' , "%{$q}%" )
			->select( DB::raw(
				'tb_invoice.*, tb_customer.*,tb_delivery_type.*, tb_tax_type.*, tb_sales_status.*,users.*,total,
				(vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function insert($input){
        return DB::table('tb_invoice')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_invoice')
            ->where('invoice_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
        DB::table('tb_invoice')
            ->where('invoice_id', '=', $id)
            ->delete();
	}

	public static function select_customer($q) {
		$sql = "select tb_invoice.id, tb_invoice.id_dept, tb_invoice.date_dept, tb_invoice.total, tb_invoice.id_customer, customer.name_company
			from tb_invoice inner join customer on tb_invoice.id_customer = customer.id_customer
			where tb_invoice.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
