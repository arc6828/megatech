<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
  protected $table = 'tb_order';
  protected $primaryKey = 'order_id';
  protected $fillable = [
    'order_code',
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
    'vat',
    'total_before_vat',
    'internal_reference_id',
    'external_reference_id',
    'total',
    'po_file',
    'staff_id',
  ];

  public function QuotationDetail()
  {
    return $this->hasMany('App\Sales\QuotationDetailModel', 'quotation_id');
  }
  public function order_details()
  {
    return $this->hasMany('App\Sales\OrderDetailModel', 'order_id');
  }

  public function invoices()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'internal_reference_id', 'order_code');
  }
  public function sales_status()
  {
    return $this->belongsTo('App\SalesStatusModel', 'sales_status_id');
  }

  public function pickings()
  {
    return $this->hasMany('App\Sales\PickingModel', 'order_code');
  }
  public function User()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function staff()
  {
    return $this->belongsTo('App\User', 'staff_id');
  }
  public function Customer()
  {
    return $this->belongsTo('App\CustomerModel', 'customer_id');
  }

}
