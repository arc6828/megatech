<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceDetailModel extends Model
{
  protected $table = 'tb_invoice_detail';
  protected $primaryKey = 'invoice_detail_id';
  protected $fillable = [
    'product_id',
    'amount',
    'discount_price',
    'invoice_id',
  ];
 
  public function invoice(){
    return $this->belongsTo('App\sales\InvoiceModel','invoice_id');
  }
  public function Product(){
    return $this->belongsTo('App\ProductModel','product_id');
  }

}
