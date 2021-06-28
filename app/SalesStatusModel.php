<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesStatusModel extends Model
{
  protected $table = "tb_sales_status";
  protected $primaryKey = 'sales_status_id';
  protected $fillable = [];

  public function invoice()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'sales_status_id');
  }
  public function order()
  {
    return $this->hasMany('App\Sales\OrderModel', 'sales_status_id');
  }
  public function quotation()
  {
    return $this->hasMany('App\Sales\QuotationModel', 'sales_status_id');
  }
  public function return_invoice()
  {
    return $this->hasMany('App\Sales\ReturnInvoice', 'sales_status_id');
  }
  public function delivery_temporary()
  {
    return $this->hasMany('App\Sales\DeliveryTemporaryModel', 'sales_status_id');
  }
}
