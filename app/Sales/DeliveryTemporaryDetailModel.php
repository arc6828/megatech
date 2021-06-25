<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryTemporaryDetailModel extends Model
{
  protected $table = "tb_delivery_temporary_detail";
  protected $primaryKey = 'delivery_temporary_detail_id';
  protected $fillable = [
    'product_id',
    'amount',
    'discount_price',
    'delivery_temporary_id',
    'delivery_temporary_detail_remark',
    'danger_price',
    'delivery_duration'
  ];
}
