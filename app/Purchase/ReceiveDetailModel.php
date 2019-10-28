<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiveDetailModel extends Model
{
  protected $table = 'tb_purchase_receive_detail';
  protected $primaryKey = 'purchase_receive_detail_id';
  protected $fillable = [];


  public function Receive()
  {
      return $this->belongsTo('App\Purchase\ReceiveModel',' puchase_receive_id');
  }
  public function Product()
  {
      return $this->belongsTo('App\ProductModel','product_id');
  }
  
  

  public static function select_all(){
		return DB::table('tb_purchase_receive_detail')
      ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
      ->get();
	}

	public static function select_by_purchase_receive_id($purchase_receive_id){
    return DB::table('tb_purchase_receive_detail')
        ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
        ->where('purchase_receive_id', '=' , $purchase_receive_id )
        ->get();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_receive_detail')
        ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
        ->where('purchase_receive_detail_id', '=' , $id )
        ->get();
	}

  public static function insert($input){
    DB::table('tb_purchase_receive_detail')->insert($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_receive_detail')
        ->where('purchase_receive_detail_id', $id)
        ->update($input);
	}

  public static function update_key_by_id($key, $input, $id){
    DB::table('tb_purchase_receive_detail')
        ->where('purchase_receive_detail_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_purchase_receive_detail')
            ->where('purchase_receive_detail_id', '=', $id)
            ->delete();
	}

  public static function delete_by_purchase_receive_id($purchase_receive_id){
		DB::table('tb_purchase_receive_detail')
        ->where('purchase_receive_id', '=', $purchase_receive_id)
        ->delete();
	}

  //EXTENSION ABOUT ORDER
  public static function select_search($purchase_receive_detail_status_id,$date_begin,$date_end=""){
    $tail = "";
    if($date_end === ""){
      $date_end = $date_begin;
      $tail = " + INTERVAL 1 MONTH";
    }
    //echo $purchase_receive_detail_status_id;
    //echo "s".$date_begin;
    //echo "s".$date_end;
    //echo $tail;
    return DB::table('tb_purchase_receive_detail')
        ->join('tb_product','tb_purchase_receive_detail.product_id','=','tb_product.product_id')
        ->join('tb_purchase_receive','tb_purchase_receive.purchase_receive_id','=','tb_purchase_receive_detail.purchase_receive_id')
        ->join('tb_customer', 'tb_purchase_receive.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_purchase_receive_detail_status', 'tb_purchase_receive_detail.purchase_receive_detail_status_id', '=', 'tb_purchase_receive_detail_status.purchase_receive_detail_status_id')
        ->where("tb_purchase_receive_detail.purchase_receive_detail_status_id","=",$purchase_receive_detail_status_id)
        //->whereBetween("datetime",">=",[$date_begin,$date_end])
        ->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
	}

  public static function duplicate_by_id($new_amount, $id){
    $sql = "INSERT INTO tb_purchase_receive_detail
      SELECT null,product_id,{$new_amount},{$new_amount},discount_price,purchase_receive_id,purchase_receive_detail_status_id
      FROM tb_purchase_receive_detail
      WHERE purchase_receive_detail_id = {$id}";
    return DB::insert($sql);
  }

  public static function update_purchase_receive_detail_status_id_by_ids($action, $ids){
    DB::table('tb_purchase_receive_detail')
      ->whereIn('purchase_receive_detail_id', $ids)
      ->update(['purchase_receive_detail_status_id' => $action]);
	}
}
