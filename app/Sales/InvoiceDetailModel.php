<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceDetailModel extends Model
{
  protected $table = 'tb_invoice_detail';
  protected $primaryKey = 'invoice_detail_id';
  protected $fillable = [
    'product_id',
    'amount',
    'discount_price',
    'invoice_id',
  ];
 
  public function invoice(){
    return $this->belongsTo('App\sales\InvoiceModel','invoice_id');
  }
  public function Product(){
    return $this->belongsTo('App\ProductModel','product_id');
  }

 

  public static function select_all(){
		return DB::table('tb_invoice_detail')
      ->join('tb_product','tb_invoice_detail.product_id','=','tb_product.product_id')
      ->get();
	}

	public static function select_by_invoice_id($invoice_id){
    return DB::table('tb_invoice_detail')
        ->join('tb_product','tb_invoice_detail.product_id','=','tb_product.product_id')
        ->where('invoice_id', '=' , $invoice_id )
        ->get();
	}

	// public static function select_by_id($id){
  //   return DB::table('tb_invoice_detail')
  //       ->join('tb_product','tb_invoice_detail.product_id','=','tb_product.product_id')
  //       ->where('tb_invoice_detail.product_id', '=' , $id )
  //       ->get();
  //       // print_r()
	// }

  public static function insert($input){
    DB::table('tb_invoice_detail')->insert($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_invoice_detail')
        ->where('invoice_detail_id', $id)
        ->update($input);
	}

  public static function update_key_by_id($key, $input, $id){
    DB::table('tb_invoice_detail')
        ->where('invoice_detail_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_invoice_detail')
            ->where('invoice_detail_id', '=', $id)
            ->delete();
	}

  public static function delete_by_invoice_id($invoice_id){
		DB::table('tb_invoice_detail')
        ->where('invoice_id', '=', $invoice_id)
        ->delete();
	}

  //EXTENSION ABOUT ORDER
  public static function select_search($invoice_detail_status_id,$date_begin,$date_end=""){
    $tail = "";
    if($date_end === ""){
      $date_end = $date_begin;
      $tail = " + INTERVAL 1 MONTH";
    }
    //echo $invoice_detail_status_id;
    //echo "s".$date_begin;
    //echo "s".$date_end;
    //echo $tail;
    return DB::table('tb_invoice_detail')
        ->join('tb_product','tb_invoice_detail.product_id','=','tb_product.product_id')
        ->join('tb_invoice','tb_invoice.invoice_id','=','tb_invoice_detail.invoice_id')
        ->join('tb_customer', 'tb_invoice.customer_id', '=', 'tb_customer.customer_id')
        ->join('tb_invoice_detail_status', 'tb_invoice_detail.invoice_detail_status_id', '=', 'tb_invoice_detail_status.invoice_detail_status_id')
        ->where("tb_invoice_detail.invoice_detail_status_id","=",$invoice_detail_status_id)
        //->whereBetween("datetime",">=",[$date_begin,$date_end])
        ->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
        ->select( DB::raw('*,DATE(datetime) as date'))
        ->get();
	}

  public static function duplicate_by_id($new_amount, $id){
    $sql = "INSERT INTO tb_invoice_detail
      SELECT null,product_id,{$new_amount},{$new_amount},discount_price,invoice_id,invoice_detail_status_id
      FROM tb_invoice_detail
      WHERE invoice_detail_id = {$id}";
    return DB::insert($sql);
  }

  public static function update_invoice_detail_status_id_by_ids($action, $ids){
    DB::table('tb_invoice_detail')
      ->whereIn('invoice_detail_id', $ids)
      ->update(['invoice_detail_status_id' => $action]);
	}
}
