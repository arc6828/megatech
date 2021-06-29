<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisitionModel extends Model
{
  protected $table = "tb_purchase_requisition";
  protected $primaryKey = 'purchase_requisition_id';
  protected $fillable = [
    'purchase_requisition_code',
    'external_reference_id',
    'customer_id',
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
    'total'
  ];

  public function requisition_details()
  {
    return $this->hasMany('App\Purchase\RequisitionDetailModel', 'purchase_requisition_id');
  }
  public function User()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function Customer()
  {
    return $this->belongsTo('App\Customer', 'customer_id');
  }
  public function purchase_status()
  {
    return $this->belongsTo('App\PurchaseStatusModel', 'purchase_status_id');
  }
}
