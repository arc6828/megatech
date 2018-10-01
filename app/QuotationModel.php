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

	public static function select_by_id($id){
        return DB::table('tb_quotation')
            ->where('quotation_id', '=' , $id )
            ->get();
	}

	public static function select_by_keyword($q){
        return DB::table('tb_quotation')
            ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
            ->join('users', 'tb_quotation.user_id', '=', 'users.id')
            ->where('quotation_id', 'like' , "%{$q}%" )
            ->get();
	}

	public static function insert($input){
        DB::table('tb_quotation')->insert($input);
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
