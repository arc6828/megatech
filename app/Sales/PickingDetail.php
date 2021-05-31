<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class PickingDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tb_sales_picking_details';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'sales_picking_detail_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'amount',
        'approved_amount', 'iv_amount', 'before_approved_amount',
        'discount_price', 'order_id', 'order_code', 'order_detail_status_id',
        'invoice_code', 'danger_price', 'picking_code', 'sale_status_id', 'quotation_code',
        'delivery_duration', 'sales_picking_detail_id',
    ];
    
    public function pickings()
    {
        return $this->hasMany('App\Sales\PickingModel', 'picking_code');
    }

}
