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

 
}
