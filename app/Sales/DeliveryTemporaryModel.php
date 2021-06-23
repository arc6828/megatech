<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DeliveryTemporaryModel extends Model
{
  protected $table = 'tb_delivery_temporary';
  protected $primaryKey = 'delivery_temporary_id';
  protected $fillable = [
    'staff_id',
    'delivery_temporary_code',
    'datetime',
    'customer_id',
    'contact_name',
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
    'internal_reference_doc',
    'external_reference_doc',
    'total',
    'revision'
  ];

  public function sales_status()
  {
    return $this->belongsTo('App\SalesStatusModel', 'sales_status_id');
  }

  public function staff()
  {
    return $this->belongsTo('App\User', 'staff_id');
  }

  public function delivery_temporary_details()
  {
    return $this->hasMany('App\Sales\DeliveryTemporaryDetailModel', 'delivery_temporary_id');
  }

  // public static function select_all_by_user_id($user_id)
  // {
  //   return DB::table('tb_delivery_temporary')
  //     ->join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
  //     ->join('tb_delivery_type', 'tb_delivery_temporary.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
  //     ->join('tb_tax_type', 'tb_delivery_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
  //     ->join('tb_sales_status', 'tb_delivery_temporary.sales_status_id', '=', 'tb_sales_status.sales_status_id')
  //     ->join('users', 'tb_delivery_temporary.staff_id', '=', 'users.id')
  //     ->where('tb_delivery_temporary.user_id', '=', $user_id)
  //     ->get();
  // }

  // public static function select_all()
  // {
  //   return DB::table('tb_delivery_temporary')
  //     ->join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
  //     ->join('tb_delivery_type', 'tb_delivery_temporary.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
  //     ->join('tb_tax_type', 'tb_delivery_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
  //     ->join('tb_sales_status', 'tb_delivery_temporary.sales_status_id', '=', 'tb_sales_status.sales_status_id')
  //     ->join('users', 'tb_delivery_temporary.staff_id', '=', 'users.id')
  //     ->get();
  // }
  // public static function select_count_by_current_month()
  // {
  //   //SELECT count(*) FROM `tb_delivery_temporary` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
  //   return DB::table('tb_delivery_temporary')
  //     ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
  //     ->where('sales_status_id', '!=', '-1')
  //     ->count();
  // }

  // public static function select_by_id($id)
  // {
  //   return DB::table('tb_delivery_temporary')
  //     ->join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
  //     ->where('tb_delivery_temporary.delivery_temporary_id', '=', $id)
  //     //->select( DB::raw('tb_delivery_temporary.*, tb_customer.contact_name'))
  //     ->select(DB::raw(
  //       'tb_customer.*,tb_delivery_temporary.*'
  //     ))
  //     ->get();
  // }

  // public static function select_by_keyword($q)
  // {
  //   return DB::table('tb_delivery_temporary')
  //     ->join('tb_customer', 'tb_delivery_temporary.customer_id', '=', 'tb_customer.customer_id')
  //     ->join('tb_delivery_type', 'tb_delivery_temporary.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
  //     ->join('tb_tax_type', 'tb_delivery_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
  //     ->join('tb_sales_status', 'tb_delivery_temporary.sales_status_id', '=', 'tb_sales_status.sales_status_id')
  //     ->join('users', 'tb_delivery_temporary.user_id', '=', 'users.id')
  //     ->select(DB::raw(
  //       'tb_delivery_temporary.*, tb_customer.contact_name'
  //     ))
  //     ->get();
  // }

  // public static function insert($input)
  // {
  //   return DB::table('tb_delivery_temporary')->insertGetId($input);
  // }

  // public static function update_by_id($input, $id)
  // {
  //   DB::table('tb_delivery_temporary')
  //     ->where('delivery_temporary_id', $id)
  //     ->update($input);
  // }

  // public static function delete_by_id($id)
  // {
  //   DB::table('tb_delivery_temporary')
  //     ->where('delivery_temporary_id', '=', $id)
  //     ->delete();
  // }
}
