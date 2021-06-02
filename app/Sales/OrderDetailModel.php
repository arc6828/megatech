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

    public static function select_all()
    {
        return DB::table('tb_order_detail')
            ->join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
            ->get();
    }

    public static function select_by_order_id($order_id)
    {
        return DB::table('tb_order_detail')
            ->join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
            ->where('order_id', '=', $order_id)
            ->get();
    }

    //EXTENSION OF ORDER
    public static function select_by_order_id_by_status_id($order_id, $order_detail_status_id)
    {
        return DB::table('tb_order_detail')
            ->join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
            ->where('order_id', '=', $order_id)
            ->where('order_detail_status_id', '=', $order_detail_status_id)
            ->get();
    }

    public static function select_by_id($id)
    {
        return DB::table('tb_order_detail')
            ->join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
            ->where('order_detail_id', '=', $id)
            ->get();
    }

    public static function insert($input)
    {
        DB::table('tb_order_detail')->insert($input);
    }

    public static function update_by_id($input, $id)
    {
        DB::table('tb_order_detail')
            ->where('order_detail_id', $id)
            ->update($input);
    }

    public static function update_key_by_id($key, $input, $id)
    {
        DB::table('tb_order_detail')
            ->where('order_detail_id', $id)
            ->update($input);
    }

    public static function delete_by_id($id)
    {
        DB::table('tb_order_detail')
            ->where('order_detail_id', '=', $id)
            ->delete();
    }

    public static function delete_by_order_id($order_id)
    {
        DB::table('tb_order_detail')
            ->where('order_id', '=', $order_id)
            ->delete();
    }

    //EXTENSION ABOUT ORDER
    // public static function select_search($order_detail_status_id, $date_begin, $date_end = "")
    // {
    //     $tail = "";
    //     if ($date_end === "") {
    //         $date_end = $date_begin;
    //         $tail = " + INTERVAL 1 MONTH";
    //     }
    //     //echo $order_detail_status_id;
    //     //echo "s".$date_begin;
    //     //echo "s".$date_end;
    //     //echo $tail;
    //     return DB::table('tb_order_detail')
    //         ->join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
    //         ->join('tb_order', 'tb_order.order_id', '=', 'tb_order_detail.order_id')
    //         ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
    //         ->join('tb_order_detail_status', 'tb_order_detail.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
    //         ->where("tb_order_detail.order_detail_status_id", "=", $order_detail_status_id)
    //         ->where("tb_order_detail.amount", ">", 0)
    //     //->whereBetween("datetime",">=",[$date_begin,$date_end])
    //         ->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
    //         ->select(DB::raw('*,DATE(datetime) as date'))
    //         ->get();
    // }

    //No Filter Date, but status_id
    // public static function select_search2($order_detail_status_id)
    // {

    //     return DB::table('tb_order_detail')
    //         ->join('tb_product', 'tb_order_detail.product_id', '=', 'tb_product.product_id')
    //         ->join('tb_order', 'tb_order.order_id', '=', 'tb_order_detail.order_id')
    //         ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
    //         ->join('tb_order_detail_status', 'tb_order_detail.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
    //         ->where("tb_order_detail.order_detail_status_id", "=", $order_detail_status_id)
    //         ->where("tb_order_detail.amount", ">", 0)
    //     //->whereBetween("datetime",">=",[$date_begin,$date_end])
    //     //->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
    //         ->select(DB::raw('*,DATE(datetime) as date'))
    //         ->get();
    // }

    // public static function duplicate_by_id($new_amount, $id)
    // {
    //     $sql = "INSERT INTO tb_order_detail ( product_id, amount, approved_amount, discount_price,  order_id, order_detail_status_id )
    //   SELECT product_id,{$new_amount},{$new_amount},discount_price,order_id,order_detail_status_id
    //   FROM tb_order_detail
    //   WHERE order_detail_id = {$id}";
    //     return DB::insert($sql);
    // }

    public static function update_order_detail_status_id_by_ids($action, $ids)
    {
        //DEPLICATE
        DB::table('tb_order_detail')
            ->whereIn('order_detail_id', $ids)
            ->update(['order_detail_status_id' => $action]);
    }

    public static function countWaitApprove($order_id)
    {
        //3: MEANS รออนุมัติ
        return DB::table('tb_order_detail')
            ->where('order_detail_status_id', 3)
            ->where('order_id', $order_id)
            ->count();
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
