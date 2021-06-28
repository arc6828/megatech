<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiveModel extends Model
{
  protected $table = 'tb_purchase_receive';
  protected $primaryKey = 'purchase_receive_id';
  protected $fillable = [
    'purchase_receive_code',
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
    'external_reference_doc',
    'internal_reference_doc',
    'total',
    'total_payment',
    'total_debt',
    'file',
  ];


  public function purchase_receive_details()
  {
    return $this->hasMany('App\Purchase\ReceiveDetailModel', 'purchase_receive_id');
  }

  public function purchase_order()
  {
    return $this->belongsTo('App\Purchase\OrderModel', 'internal_reference_doc', 'purchase_order_code');
  }

  public function supplier_billing_detail()
  {
    return $this->hasOne('App\SupplierBillingDetail', 'doc_id');
  }

  public function User()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function Customer()
  {
    return $this->belongsTo('App\Customer', 'customer_id');
  }
  public function Supplier()
  {
    return $this->belongsTo('App\SupplierModel', 'supplier_id');
  }
  public function tax_type()
  {
    return $this->belongsTo('App\TaxTypeModel', 'tax_type_id', 'tax_type_id');
  }
  public function purchase_status()
  {
    return $this->belongsTo('App\PurchaseStatusModel', 'purchase_status_id');
  }
}
