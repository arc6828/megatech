<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class PickingModel extends Model
{
    protected $table = 'tb_sales_picking';
    protected $primaryKey = 'sales_picking_id';
    protected $fillable = ['picking_code', 'order_code', 'sales_picking_id', 'datetime', 'remark'];

    public function order()
    {
        return $this->belongsTo('App\Sales\OrderModel', 'order_code');
    }
    public function picking_details()
    {
        return $this->hasMany('App\Sales\PickingDetail', 'picking_code');
    }
}

