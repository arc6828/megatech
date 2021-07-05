<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class QuotationModel extends Model
{
  protected $table = 'tb_quotation';
  protected $primaryKey = 'quotation_id';
  protected $fillable = [
    'quotation_code',
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
    'zone_id', 'remark',
    'vat_percent', 'vat',
    'total_before_vat',
    'internal_reference_doc',
    'external_reference_doc',
    'total',
    'staff_id',
    'revision',
    'file'
  ];

  public function quotation_details()
  {
    return $this->hasMany('App\Sales\QuotationDetailModel', 'quotation_id');
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
