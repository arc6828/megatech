<?php

namespace App;

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

class QuotationModel extends Model
{
    public static function select_all(){
        return DB::table('tb_quotation')
            ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_quotation.user_id', '=', 'users.id')
            ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_quotation` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_quotation')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            //->where('month(datetime)', 'month(now())')
            //->where('year(datetime)', 'year(now())')
            ->count();
	}

	public static function select_by_id($id){
        return DB::table('tb_quotation')
            ->where('quotation_id', '=' , $id )
            ->get();
	}

	public static function select_by_keyword($q){
      //SELECT * FROM `tb_quotation`
      //Left JOIN ( SELECT sum(discount_price) as total_discount_price , quotation_id FROM `tb_quotation_detail` GROUP BY quotation_id ) q
      //on `tb_quotation`.`quotation_id` = q.quotation_id

        $total_query = DB::table('tb_quotation_detail')
             ->select('quotation_id', DB::raw('sum(discount_price) as total_before_vat'))
             ->groupBy('quotation_id');
        return DB::table('tb_quotation')
            ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_quotation.user_id', '=', 'users.id')
            ->leftJoinSub($total_query, 'total_query', function($join) {
                $join->on('tb_quotation.quotation_id', '=', 'total_query.quotation_id');
            })
            ->where('quotation_code', 'like' , "%{$q}%" )
            ->orWhere('company_name', 'like' , "%{$q}%" )
            ->orWhere('customer_name', 'like' , "%{$q}%" )
            ->orWhere('sales_status_name', 'like' , "%{$q}%" )
            ->get();
	}

	public static function insert($input){
        return DB::table('tb_quotation')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_quotation')
            ->where('quotation_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
        DB::table('tb_quotation')
            ->where('quotation_id', '=', $id)
            ->delete();
	}

	public static function select_customer($q) {
		$sql = "select tb_quotation.id, tb_quotation.id_dept, tb_quotation.date_dept, tb_quotation.total, tb_quotation.id_customer, customer.name_company
			from tb_quotation inner join customer on tb_quotation.id_customer = customer.id_customer
			where tb_quotation.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
