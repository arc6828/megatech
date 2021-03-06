<?php
namespace App\Sales\unused;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class OrderDetailModel extends Model
{
  public static function select_all(){
    return DB::table('tb_order_detail')
        ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_order','tb_order.order_id','=','tb_order_detail.order_id')
        ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_order_detail_status', 'tb_order_detail.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
	}
  public static function select_search($order_detail_status_id,$date_begin,$date_end=""){
    $tail = "";
    if($date_end === ""){
      $date_end = $date_begin;
      $tail = " + INTERVAL 1 MONTH";
    }
    //echo $order_detail_status_id;
    //echo "s".$date_begin;
    //echo "s".$date_end;
    //echo $tail;
    return DB::table('tb_order_detail')
        ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_order','tb_order.order_id','=','tb_order_detail.order_id')
        ->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_order_detail_status', 'tb_order_detail.order_detail_status_id', '=', 'tb_order_detail_status.order_detail_status_id')
        ->where("tb_order_detail.order_detail_status_id","=",$order_detail_status_id)
        //->whereBetween("datetime",">=",[$date_begin,$date_end])
        ->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
	}
	public static function select_by_order_id($order_id){
    return DB::table('tb_order_detail')
      ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
      ->where('order_id', '=' , $order_id )
      ->get();
	}
  public static function select_by_order_id_by_status_id($order_id, $order_detail_status_id){
    return DB::table('tb_order_detail')
      ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
      ->where('order_id', '=' , $order_id )
      ->where('order_detail_status_id', '=' , $order_detail_status_id )
      ->get();
	}
	public static function select_by_id($id){
    return DB::table('tb_order_detail')
      ->join('tb_product','tb_order_detail.product_id','=','tb_product.product_id')
      ->where('order_detail_id', '=' , $id )
      ->get();
	}
  public static function insert($input){
        return DB::table('tb_order_detail')->insertGetId($input);
	}
  public static function insert_by_order_detail_id($new_amount, $order_detail_id){
    $sql = "INSERT INTO tb_order_detail
      SELECT null,product_id,{$new_amount},{$new_amount},discount_price,order_id,order_detail_status_id
      FROM tb_order_detail
      WHERE order_detail_id = {$order_detail_id}";
    return DB::insert($sql);
  }
	public static function update_by_id($input, $id){
    DB::table('tb_order_detail')
      ->where('order_detail_id', $id)
      ->update($input);
	}
  public static function update_order_detail_status_id_by_ids($action, $ids){
    DB::table('tb_order_detail')
      ->whereIn('order_detail_id', $ids)
      ->update(['order_detail_status_id' => $action]);
	}
  public static function update_amount_by_approve_amount($action, $ids){
    DB::table('tb_order_detail')
      ->whereIn('order_detail_id', $ids)
      ->update(['order_detail_status_id' => $action]);
	}
  public static function update_key_by_id($key, $input, $id){
    DB::table('tb_order_detail')
        ->where('order_detail_id', $id)
        ->update($input);
	}
	public static function delete_by_id($id){
		DB::table('tb_order_detail')
      ->where('order_detail_id', '=', $id)
      ->delete();
	}
}
