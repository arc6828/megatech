<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class QuotationModel extends Model
{
  protected $table = 'tb_quotation';

  public static function select_all_by_user_id($user_id){
    return DB::table('tb_quotation')
        ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
        ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
        ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        ->join('users', 'tb_quotation.user_id', '=', 'users.id')
        ->where('tb_quotation.user_id', '=', $user_id)
        ->get();
  }

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
          ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_quotation')
      ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_quotation.quotation_id', '=' , $id )
			->select( DB::raw('tb_quotation.*, tb_customer.contact_name'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_quotation')
      ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_quotation.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_quotation.*, tb_customer.contact_name'
        ))
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

}
