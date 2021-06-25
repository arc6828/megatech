<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetailModel extends Model
{
    protected $table = "tb_order_detail";
    protected $primaryKey = 'order_detail_id';
    protected $fillable = [
        'product_id',
        'amount',
        'approved_amount',
        'iv_amount',
        'before_approved_amount',
        'discount_price',
        'order_id',
        'order_detail_status_id',
        'invoice_code',
        'danger_price',
        'picking_code',
        'sale_status_id',
        'quotation_code',
        'delivery_duration',
    ];
    public function Quotation()
    {
        return $this->belongsTo('App\Sales\QuotationModel', 'quotation_id');
    }

    public function product()
    {
        return $this->belongsTo('App\ProductModel', 'product_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Sales\OrderModel', 'order_id');
    }

    public static function countWaitIV($order_id)
    {
        //1: MEANS อนุมัติ
        //3: MEANS รออนุมัติ
        return DB::table('tb_order_detail')
            ->join('tb_order', 'tb_order.order_id', '=', 'tb_order_detail.order_id')
            ->whereIn('order_detail_status_id', [1, 3])
            ->where(function ($query) use ($order_id) {
                $query->where('tb_order.order_id', $order_id)
                    ->orWhere('order_code', $order_id);
            })
            ->count();
    }
}
