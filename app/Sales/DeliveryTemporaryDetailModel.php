<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryTemporaryDetailModel extends Model
{
  protected $table = "tb_delivery_temporary_detail";
  protected $primaryKey = 'delivery_temporary_detail_id';
  protected $fillable = ['product_id', 'amount', 'discount_price', 'delivery_temporary_id', 'delivery_temporary_detail_remark', 'danger_price', 'delivery_duration'];

  public static function select_all()
  {
    return DB::table('tb_delivery_temporary_detail')
      ->join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_delivery_temporary', 'tb_delivery_temporary_detail.delivery_temporary_id', '=', 'tb_delivery_temporary.delivery_temporary_id')
      ->get();
  }

  public static function select_by_delivery_temporary_id($delivery_temporary_id)
  {
    return DB::table('tb_delivery_temporary_detail')
      ->join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('delivery_temporary_id', '=', $delivery_temporary_id)
      ->get();
  }

  public static function select_by_customer_id($customer_id)
  {
    return DB::table('tb_delivery_temporary_detail')
      ->join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_delivery_temporary', 'tb_delivery_temporary_detail.delivery_temporary_id', '=', 'tb_delivery_temporary.delivery_temporary_id')
      ->where('customer_id', '=', $customer_id)
      ->get();
  }

  public static function select_by_user_id($customer_id, $user_id)
  {
    return DB::table('tb_delivery_temporary_detail')
      ->join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->join('tb_delivery_temporary', 'tb_delivery_temporary_detail.delivery_temporary_id', '=', 'tb_delivery_temporary.delivery_temporary_id')
      ->where('user_id', '=', $user_id)
      ->where('customer_id', '=', $customer_id)
      ->get();
  }

  public static function select_by_id($id)
  {
    return DB::table('tb_delivery_temporary_detail')
      ->join('tb_product', 'tb_delivery_temporary_detail.product_id', '=', 'tb_product.product_id')
      ->where('delivery_temporary_detail_id', '=', $id)
      ->get();
  }

  public static function insert($input)
  {
    DB::table('tb_delivery_temporary_detail')->insert($input);
  }

  public static function update_by_id($input, $id)
  {
    DB::table('tb_delivery_temporary_detail')
      ->where('delivery_temporary_detail_id', $id)
      ->update($input);
  }

  public static function update_key_by_id($key, $input, $id)
  {
    DB::table('tb_delivery_temporary_detail')
      ->where('delivery_temporary_detail_id', $id)
      ->update($input);
  }

  public static function delete_by_id($id)
  {
    DB::table('tb_delivery_temporary_detail')
      ->where('delivery_temporary_detail_id', '=', $id)
      ->delete();
  }

  public static function delete_by_delivery_temporary_id($delivery_temporary_id)
  {
    DB::table('tb_delivery_temporary_detail')
      ->where('delivery_temporary_id', '=', $delivery_temporary_id)
      ->delete();
  }
}
