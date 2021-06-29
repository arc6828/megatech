<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;

class ReceiveTemporaryDetailModel extends Model
{
  protected $table = "tb_receive_temporary_detail";
  protected $primaryKey = 'receive_temporary_detail_id';
  protected $fillable = ['product_id', 'amount', 'discount_price', 'receive_temporary_id', 'receive_temporary_detail_remark', 'danger_price', 'receive_duration'];

  public function receive_temporary()
  {
    return $this->belongsTo('App\Purchase\ReceiveTemporaryModel', 'receive_temporary_id');
  }
}
