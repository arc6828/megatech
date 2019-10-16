<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceModel extends Model
{
  protected $table = 'tb_invoice';
  protected $primaryKey = 'invoice_id';
  protected $fillable = [
                          'invoice_code',
                          'datetime',
                          'customer_id',
                          'debt_duration',
                          'billing_duration',
                          'payment_condition',
                          'delivery_type_id',
                          'tax_type_id',
                          'delivery_time',
                          'department_id',
                          'sales_status_id',
                          'user_id',
                          'zone_id',
                          'remark',
                          'vat_percent',
                          'external_reference_id',
                          'internal_reference_id',
                          'total',
                        ];
  public function QuotationDetail(){
    return $this->hasMany('App\Sales\QuotationDetailModel','quotation_id');
  }
  public function User(){
    return $this->belongsTo('App\User','user_id');
  }
  public function Customer(){
    return $this->belongsTo('App\CustomerModel','customer_id');
  }
  public static function select_all_by_user_id($user_id){
    return DB::table('tb_invoice')
        ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
        ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
        ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        ->join('users', 'tb_invoice.user_id', '=', 'users.id')
        ->where('tb_invoice.user_id', '=', $user_id)
        ->get();
  }
  public static function select_all(){
    return DB::table('tb_invoice')
        ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
        ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
        ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        ->join('users', 'tb_invoice.user_id', '=', 'users.id')
        ->get();
	}
  public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_invoice` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_invoice')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_invoice')
      ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_invoice.invoice_id', '=' , $id )
			->select( DB::raw('tb_customer.*,tb_invoice.*'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_invoice')
      ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_invoice.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_invoice.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_sales_status', 'tb_invoice.sales_status_id', '=', 'tb_sales_status.sales_status_id')
      ->join('users', 'tb_invoice.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_invoice.*, tb_customer.contact_name, tb_customer.company_name'
        ))
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

}
