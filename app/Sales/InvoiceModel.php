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
    'total_payment',
    'total_debt',
    'staff_id',
  ];

  public function QuotationDetail()
  {
    return $this->hasMany('App\Sales\QuotationDetailModel', 'quotation_id');
  }

  public function invoice_details()
  {
    return $this->hasMany('App\Sales\InvoiceDetailModel', 'invoice_id');
  }
  public function sales_status()
  {
    return $this->belongsTo('App\SalesStatusModel', 'sales_status_id');
  }
  public function Order()
  {
    return $this->belongsTo('App\Sales\OrderModel', 'internal_reference_id', 'order_code');
  }

  public function customer_billing_detail()
  {
    return $this->hasOne('App\CustomerBillingDetail', 'doc_id');
  }

  public function User()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function staff()
  {
    return $this->belongsTo('App\User', 'staff_id');
  }
  public function customer()
  {
    return $this->belongsTo('App\CustomerModel', 'customer_id');
  }

  public function tax_type()
  {
    return $this->belongsTo('App\TaxTypeModel', 'tax_type_id', 'tax_type_id');
  }
}
