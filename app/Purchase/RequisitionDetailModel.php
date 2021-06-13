<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisitionDetailModel extends Model
{

  protected $table = "tb_purchase_requisition_detail";
  protected $primaryKey = 'purchase_requisition_detail_id';
  protected $fillable = [
    'product_id',
    'amount',
    'approved_amount',
    'before_approved_amount',
    'discount_price',
    'purchase_requisition_id',
    'purchase_order_id',
    'supplier_amount', 
    'po_amount',
    'purchase_requisition_detail_status_id',
    'supplier_id'
  ];


  public function Requisition()
  {
    return $this->belongsTo('App\Purchase\RequisitionModel', 'purchase_requisition_id');
  }
  public function RequisitionDetailStatus()
  {
    return $this->belongsTo('App\Purchase\RequisitionDetailStatusModel', 'purchase_requisition_detail_status_id');
  }
  public function Product()
  {
    return $this->belongsTo('App\ProductModel', 'product_id');
  }




  public static function select_all()
  {
    return DB::table('tb_purchase_requisition_detail')
      ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->get();
  }

  // public static function select_by_purchase_requisition_id($purchase_requisition_id)
  // {
  //   return DB::table('tb_purchase_requisition_detail')
  //     ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
  //     ->where('purchase_requisition_id', '=', $purchase_requisition_id)
  //     ->get();
  // }

  //EXTENSION OF ORDER
  public static function select_by_purchase_requisition_id_by_status_id($purchase_requisition_id, $purchase_requisition_detail_status_id)
  {
    return DB::table('tb_purchase_requisition_detail')
      ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->where('purchase_requisition_id', '=', $purchase_requisition_id)
      ->where('purchase_requisition_detail_status_id', '=', $purchase_requisition_detail_status_id)
      ->get();
  }

  public static function select_by_id($id)
  {
    return DB::table('tb_purchase_requisition_detail')
      ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
      ->where('purchase_requisition_detail_id', '=', $id)
      ->get();
  }

  // public static function insert($input)
  // {
  //   DB::table('tb_purchase_requisition_detail')->insert($input);
  // }

  public static function update_by_id($input, $id)
  {
    DB::table('tb_purchase_requisition_detail')
      ->where('purchase_requisition_detail_id', $id)
      ->update($input);
  }

  public static function update_key_by_id($key, $input, $id)
  {
    DB::table('tb_purchase_requisition_detail')
      ->where('purchase_requisition_detail_id', $id)
      ->update($input);
  }

  public static function delete_by_id($id)
  {
    DB::table('tb_purchase_requisition_detail')
      ->where('purchase_requisition_detail_id', '=', $id)
      ->delete();
  }

  public static function delete_by_purchase_requisition_id($purchase_requisition_id)
  {
    DB::table('tb_purchase_requisition_detail')
      ->where('purchase_requisition_id', '=', $purchase_requisition_id)
      ->delete();
  }

  //EXTENSION ABOUT ORDER
  // public static function select_search($purchase_requisition_detail_status_id, $date_begin, $date_end = "")
  // {
  //   $tail = "";
  //   if ($date_end === "") {
  //     $date_end = $date_begin;
  //     //$date_begin = "".date("Y-m-d");
  //     // $date_end = "".date("Y-m-d") . " +  INTERVAL 1 DAY ";
  //     $date_end = date("Y-m-d");

  //     $tail = " - INTERVAL 12 MONTH ";
  //     $tail2 = " + INTERVAL 1 DAY ";
  //     //$tail = "";
  //     // echo $date_begin;
  //     // echo $date_end ;
  //     // exit();
  //   }
  //   //echo $purchase_requisition_detail_status_id;
  //   //echo "s".$date_begin;
  //   //echo "s".$date_end;
  //   //echo $tail;
  //   $whitelist = [$purchase_requisition_detail_status_id];
  //   if ($purchase_requisition_detail_status_id == 1) {
  //     $whitelist[] = 4;
  //   }
  //   return DB::table('tb_purchase_requisition_detail')
  //     ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
  //     ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
  //     ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
  //     ->leftJoin('tb_supplier', 'tb_purchase_requisition_detail.supplier_id', '=', 'tb_supplier.supplier_id')
  //     ->whereIn("tb_purchase_requisition_detail.purchase_requisition_detail_status_id", $whitelist)
  //     ->where("tb_purchase_requisition_detail.amount", ">", 0)
  //     ->where("tb_purchase_requisition_detail.before_approved_amount", ">", 0)
  //     // ->where("tb_purchase_requisition_detail.purchase_requisition_detail_status_id","=",$purchase_requisition_detail_status_id)
  //     //->whereBetween("datetime",">=",[$date_begin,$date_end])
  //     ->whereRaw("datetime >= '{$date_begin}' {$tail} AND datetime <= '{$date_end}' {$tail2} ")
  //     ->select(DB::raw('*,DATE(datetime) as date'))
  //     ->orderBy('date', 'asc')
  //     ->get();
  // }

  // public static function select_search2($purchase_requisition_detail_status_id)
  // {
  //   //USE FOR RC SELECTION
  //   return DB::table('tb_purchase_requisition_detail')
  //     ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
  //     ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
  //     ->join('tb_supplier', 'tb_supplier.supplier_id', '=', 'tb_purchase_requisition_detail.supplier_id')
  //     ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
  //     ->where("tb_purchase_requisition_detail.purchase_requisition_detail_status_id", "=", $purchase_requisition_detail_status_id)

  //     //USE FOR RC SELECTION
  //     //->whereBetween("datetime",">=",[$date_begin,$date_end])
  //     //->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
  //     //->select( DB::raw('*,DATE(datetime) as date'))
  //     ->get();
  // }

  // public static function select_search_by_supplier_id($purchase_requisition_detail_status_id, $supplier_id)
  // {

  //   return DB::table('tb_purchase_requisition_detail')
  //     ->join('tb_product', 'tb_purchase_requisition_detail.product_id', '=', 'tb_product.product_id')
  //     ->join('tb_purchase_requisition', 'tb_purchase_requisition.purchase_requisition_id', '=', 'tb_purchase_requisition_detail.purchase_requisition_id')
  //     ->join('tb_supplier', 'tb_supplier.supplier_id', '=', 'tb_purchase_requisition_detail.supplier_id')
  //     ->join('tb_purchase_requisition_detail_status', 'tb_purchase_requisition_detail.purchase_requisition_detail_status_id', '=', 'tb_purchase_requisition_detail_status.purchase_requisition_detail_status_id')
  //     ->where("tb_purchase_requisition_detail.purchase_requisition_detail_status_id", "=", $purchase_requisition_detail_status_id)
  //     ->where("tb_supplier.supplier_id", $supplier_id)
  //     //->whereBetween("datetime",">=",[$date_begin,$date_end])
  //     //->whereRaw("datetime >= '{$date_begin}' AND datetime < '{$date_end}' {$tail}")
  //     //->select( DB::raw('*,DATE(datetime) as date'))
  //     ->get();
  // }


  // public static function duplicate_by_id($new_amount, $id)
  // {
  //   $sql = "INSERT INTO tb_purchase_requisition_detail (product_id,amount,discount_price,purchase_requisition_id,purchase_requisition_detail_status_id)
  //     SELECT product_id,{$new_amount},discount_price,purchase_requisition_id,purchase_requisition_detail_status_id
  //     FROM tb_purchase_requisition_detail
  //     WHERE purchase_requisition_detail_id = {$id}";
  //   DB::insert($sql);
  //   $item = DB::table('tb_purchase_requisition_detail')->orderBy('purchase_requisition_detail_id', 'desc')->first();

  //   return $item->purchase_requisition_detail_id;
  // }

  public static function update_purchase_requisition_detail_status_id_by_ids($action, $ids)
  {
    DB::table('tb_purchase_requisition_detail')
      ->whereIn('purchase_requisition_detail_id', $ids)
      ->update(['purchase_requisition_detail_status_id' => $action]);
  }

  public static function update_purchase_requisition_detail_status_id_by_ids2($action, $ids, $purchase_requisition_detail_status_id)
  {
    DB::table('tb_purchase_requisition_detail')
      ->whereIn('purchase_requisition_detail_id', $ids)
      ->update([
        'supplier_id' => $action,
        'purchase_requisition_detail_status_id' => $purchase_requisition_detail_status_id,
      ]);
  }
}
