<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;


class QuotationDetailModel extends Model
{
  protected $table = "tb_quotation_detail";
  protected $primaryKey = 'quotation_detail_id';
  protected $fillable = [
    'product_id',
    'amount',
    'discount_price',
    'quotation_id',
    'quotation_detail_remark	',
    'danger_price',
    'sale_status_id',
    'delivery_duration',
  ];

  public function Quotation()
  {
    return $this->belongsTo('App\Sales\QuotationModel', 'quotation_id');
  }
  public function Product()
  {
    return $this->belongsTo('App\ProductModel', 'product_id');
  }
}
