<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
  protected $table = "tb_purchase_order";
  protected $primaryKey = 'purchase_order_id';
  protected $fillable = [
    'purchase_status_id',
    'purchase_order_code',
    'datetime',
    'supplier_id',
    'debt_duration',
    'billing_duration',
    'payment_condition',
    'delivery_type_id',
    'tax_type_id',
    'delivery_time',
    'department_id',
    'purchase_status_id',
    'user_id',
    'zone_id',
    'remark',
    'vat_percent',
    'internal_reference_doc',
    'external_reference_doc',
    'total_before_vat',
    'vat',
    'revision'
  ];


  // public function OrderDetail()
  // {
  //   return $this->hasMany('App\Purchase\OrderDetailModel', 'purchase_order_id');
  // }
  public function order_details()
  {
    return $this->hasMany('App\Purchase\OrderDetailModel', 'purchase_order_id');
  }
  // public function details()
  // {
  //   return $this->hasMany('App\Purchase\OrderDetailModel', 'purchase_order_id');
  // }
  public function receives()
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'internal_reference_doc', 'purchase_order_code');
  }
  public function User()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function Customer()
  {
    return $this->belongsTo('App\CustomerModel', 'customer_id');
  }
  public function supplier()
  {
    return $this->belongsTo('App\SupplierModel', 'supplier_id');
  }
  public function purchase_status()
  {
    return $this->belongsTo('App\PurchaseStatusModel', 'purchase_status_id');
  }

  public static function select_count_by_current_month_custom($date)
  {
    //SELECT count(*) FROM `tb_purchase_order` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
    return DB::table('tb_purchase_order')
      ->whereRaw("month(datetime) = month('" . $date . "') and year(datetime) = year('" . $date . "')", [])
      ->count();
  }
}
