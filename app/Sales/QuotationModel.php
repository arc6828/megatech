<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class QuotationModel extends Model
{
  protected $table = 'tb_quotation';
  protected $primaryKey = 'quotation_id';
  protected $fillable = [
                          'quotation_code','datetime','customer_id','contact_name','debt_duration','billing_duration','payment_condition','delivery_type_id','tax_type_id','delivery_time','department_id','sales_status_id','user_id','zone_id','remark','vat_percent','vat','total_before_vat','internal_reference_doc','external_reference_doc','total','staff_id'
  ];

  
  public function QuotationDetail(){
    return $this->hasMany('App\Sales\QuotationDetailModel','quotation_id');
  }
  public function details(){
    return $this->hasMany('App\Sales\QuotationDetailModel','quotation_id');
  }
  public function User(){
    return $this->belongsTo('App\User','user_id');
  }
  public function staff(){
    return $this->belongsTo('App\User','staff_id');
  }
  public function Customer(){
    return $this->belongsTo('App\CustomerModel','customer_id');
  }
  


  public static function select_all_by_user_id($user_id){
    return self::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
        ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
        ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        ->join('users', 'tb_quotation.staff_id', '=', 'users.id')
        ->where('tb_quotation.user_id', '=', $user_id)
        ->get();
  }

  public static function select_all(){
    return self::join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_delivery_type', 'tb_quotation.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
        ->join('tb_tax_type', 'tb_quotation.tax_type_id', '=', 'tb_tax_type.tax_type_id')
        ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        ->join('users', 'tb_quotation.staff_id', '=', 'users.id')
        ->get();
  }
  public static function select_count_by_current_month(){
      //SELECT count(*) FROM `tb_quotation` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
      return DB::table('tb_quotation')
          ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
          ->where('sales_status_id','!=','-1')
          ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_quotation')
      ->join('tb_customer', 'tb_quotation.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_sales_status', 'tb_quotation.sales_status_id', '=', 'tb_sales_status.sales_status_id')
        
      ->join('users', 'users.id', '=', 'tb_quotation.user_id')
      ->where('tb_quotation.quotation_id', '=' , $id )
      ->orWhere('tb_quotation.quotation_code', '=' , $id )
			->select( DB::raw('users.*,tb_customer.*, tb_quotation.*,tb_sales_status.*'))
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
        ->orWhere('quotation_code', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
    DB::table('tb_quotation')
        ->where('quotation_id', '=', $id)
        ->delete();
	}

}
