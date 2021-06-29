<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaurdStock extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'gaurd_stocks';

  /**
   * The database primary key value.
   *
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['code', 'type', 'amount', 'amount_in_stock', 'pending_in', 'pending_out', 'product_id', 'remark'];

  public function product()
  {
    return $this->belongsTo('App\ProductModel', 'product_id');
  }

  public function sales_order()
  {
    return $this->belongsTo('App\Sales\OrderModel', 'code');
  }

  public function sales_invoice()
  {
    return $this->belongsTo('App\Sales\InvoiceModel', 'code');
  }

  public function delivery_temporary()
  {
    return $this->belongsTo('App\Sales\DeliveryTemporaryModel', 'code');
  }

  public function purchase_order()
  {
    return $this->belongsTo('App\Purchase\OrderModel', 'code');
  }

  public function purchase_receive()
  {
    return $this->belongsTo('App\Purchase\ReceiveModel', 'code');
  }

  public function receive_temporary()
  {
    return $this->belongsTo('App\Purchase\ReceiveTemporaryModel', 'code');
  }
  public function adjust_stock()
  {
    return $this->belongsTo('App\AdjustStock', 'code', 'code');
  }
}
