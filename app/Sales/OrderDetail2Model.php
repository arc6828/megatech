<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class OrderDetail2Model extends Model
{
    protected $table = 'tb_order_detail2';
    protected $primaryKey = 'order_detail2_id';
    protected $fillable = ['delivery_duration'];
}
