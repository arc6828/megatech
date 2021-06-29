<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseStatusModel extends Model
{
  protected $table = "tb_purchase_status";
  protected $primaryKey = 'purchase_status_id';
  protected $fillable = [];

  public function purchase_requisition()
  {
    return $this->hasMany('App\Purchase\RequisitionModel', 'purchase_status_id');
  }
  public function receive()
  {
    return $this->hasMany('App\Purchase\ReceiveModel', 'purchase_status_id');
  }
  public function return_order()
  {
    return $this->hasMany('App\Purchase\ReturnOrder', 'purchase_status_id');
  }
}
