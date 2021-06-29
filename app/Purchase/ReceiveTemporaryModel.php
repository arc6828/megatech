<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ReceiveTemporaryModel extends Model
{
  protected $table = 'tb_receive_temporary';
  protected $primaryKey = 'receive_temporary_id';
  protected $fillable = [
    'staff_id',
    'receive_temporary_code',
    'datetime',
    'supplier_id',
    'contact_name',
    'debt_duration',
    'billing_duration',
    'payment_condition',
    'receive_type_id',
    'tax_type_id',
    'receive_time',
    'department_id',
    'purchase_status_id',
    'user_id',
    'zone_id',
    'remark',
    'vat_percent',
    'internal_reference_doc',
    'external_reference_doc',
    'total',
    'revision',
  ];

  public function purchase_status()
  {
    return $this->belongsTo('App\PurchaseStatusModel', 'purchase_status_id');
  }

  public function staff()
  {
    return $this->belongsTo('App\User', 'staff_id');
  }

  public function receive_temporary_details()
  {
    return $this->hasMany('App\Purchase\ReceiveTemporaryDetailModel', 'receive_temporary_id');
  }

}
