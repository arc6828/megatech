<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetailModel extends Model
{
    protected $table = "tb_purchase_order_detail";
    protected $primaryKey = 'purchase_order_detail_id';
    protected $fillable = ['purchase_order_detail_status_id','amount_pending_in'];

    public function Order()
    {
        return $this->belongsTo('App\Purchase\OrderModel','purchase_order_id');
    }
    public function Product()
    {
        return $this->belongsTo('App\ProductModel','product_id');
    }
    
   

  public static function select_all(){
		return DB::table('tb_purchase_order_detail')
      ->join('tb_product','tb_purchase_order_detail.product_id','=','tb_product.product_id')
      ->get();
	}

	public static function select_by_purchase_order_id($purchase_order_id){
    return DB::table('tb_purchase_order_detail')
        ->join('tb_product','tb_purchase_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_purchase_requisition_detail','tb_purchase_order_detail.requisition_detail_id','=','tb_purchase_requisition_detail.purchase_requisition_detail_id')
        ->join('tb_purchase_requisition','tb_purchase_requisition.purchase_requisition_id','=','tb_purchase_requisition_detail.purchase_requisition_id')
        ->where('purchase_order_id', '=' , $purchase_order_id )
        ->select('tb_purchase_order_detail.*', 'tb_product.*', 'tb_purchase_requisition.purchase_requisition_code')
        ->get();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_order_detail')
        ->join('tb_product','tb_purchase_order_detail.product_id','=','tb_product.product_id')
        ->where('purchase_order_detail_id', '=' , $id )
        ->get();
	}

  public static function insert($input){
    DB::table('tb_purchase_order_detail')->insert($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_order_detail')
        ->where('purchase_order_detail_id', $id)
        ->update($input);
	}

  public static function update_key_by_id($key, $input, $id){
    DB::table('tb_purchase_order_detail')
        ->where('purchase_order_detail_id', $id)
        ->update($input);
	}

  public static function decreaseAmountPendingIn($amount, $id){
    DB::table('tb_purchase_order_detail')->where('purchase_order_detail_id', $id)
      ->decrement('amount_pending_in', $amount );
  }

	public static function delete_by_id($id){
		DB::table('tb_purchase_order_detail')
            ->where('purchase_order_detail_id', '=', $id)
            ->delete();
	}

  public static function delete_by_purchase_order_id($purchase_order_id){
		DB::table('tb_purchase_order_detail')
        ->where('purchase_order_id', '=', $purchase_order_id)
        ->delete();
	}

  public static function countNotReceive($purchase_order_id){
    //5: MEANS ออก PO แล้ว, แต่ยังไม่ได้ได้รับ
    return DB::table('tb_purchase_order_detail')
        ->where('purchase_order_detail_status_id',  5)
        ->where('purchase_order_id',  $purchase_order_id)
        ->count();
  }

  //EXTENSION ABOUT ORDER
  public static function select_search($purchase_order_detail_status_id,$date_begin,$date_end=""){
    $tail = "";
    if($date_end === ""){
      $date_end = $date_begin;
      $tail = " + INTERVAL 1 MONTH";
    }
    //echo $purchase_order_detail_status_id;
    //echo "s".$date_begin;
    //echo "s".$date_end;
    //echo $tail;
    return DB::table('tb_purchase_order_detail')
        ->join('tb_product','tb_purchase_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_purchase_order','tb_purchase_order.purchase_order_id','=','tb_purchase_order_detail.purchase_order_id')
        ->join('tb_customer', 'tb_purchase_order.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_purchase_order_detail_status', 'tb_purchase_order_detail.purchase_order_detail_status_id', '=', 'tb_purchase_order_detail_status.purchase_order_detail_status_id')
        ->where("tb_purchase_order_detail.purchase_order_detail_status_id","=",$purchase_order_detail_status_id)
        //->whereBetween("datetime",">=",[$date_begin,$date_end])
        ->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
        ->where("tb_purchase_order.purchase_status_id","!=","-1")
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
	}

  //No Filter Date, but status_id
  public static function select_search2($order_detail_status_id){
    //USE FOR RC
    return DB::table('tb_purchase_order_detail')
        ->join('tb_product','tb_purchase_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_purchase_order','tb_purchase_order.purchase_order_id','=','tb_purchase_order_detail.purchase_order_id')
        ->join('tb_supplier', 'tb_purchase_order.supplier_id', '=', 'tb_supplier.supplier_id')
        //->join('tb_purchase_order_detail_status', 'tb_purchase_order_detail.order_detail_status_id', '=', 'tb_purchase_order_detail_status.order_detail_status_id')
        ->where("tb_purchase_order_detail.purchase_order_detail_status_id","=",$order_detail_status_id)
        ->where("tb_purchase_order.purchase_status_id","!=","-1")
        //->whereBetween("datetime",">=",[$date_begin,$date_end])
        //->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
  }

  //No Filter Date, but status_id
  public static function getByCondition($condition){

    return DB::table('tb_purchase_order_detail')
        ->join('tb_product','tb_purchase_order_detail.product_id','=','tb_product.product_id')
        ->join('tb_purchase_order','tb_purchase_order.purchase_order_id','=','tb_purchase_order_detail.purchase_order_id')
        ->join('tb_supplier', 'tb_purchase_order.supplier_id', '=', 'tb_supplier.supplier_id')
        //->join('tb_purchase_order_detail_status', 'tb_purchase_order_detail.order_detail_status_id', '=', 'tb_purchase_order_detail_status.order_detail_status_id')
        //->where("tb_purchase_order_detail.order_detail_status_id","=",$order_detail_status_id)
        ->where($condition)
        //->whereBetween("datetime",">=",[$date_begin,$date_end])
        //->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
  }

  public static function duplicate_by_id($new_amount, $id){
    $sql = "INSERT INTO tb_purchase_order_detail
      SELECT null,product_id,{$new_amount},{$new_amount},discount_price,purchase_order_id,purchase_order_detail_status_id
      FROM tb_purchase_order_detail
      WHERE purchase_order_detail_id = {$id}";
    return DB::insert($sql);
  }

  public static function update_purchase_order_detail_status_id_by_ids($action, $ids){
    DB::table('tb_purchase_order_detail')
      ->whereIn('purchase_order_detail_id', $ids)
      ->update(['purchase_order_detail_status_id' => $action]);
	}
}
