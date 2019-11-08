<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    protected $table = "tb_product";
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_code', 'product_name', 'product_detail', 'brand', 'promotion_price', 'floor_price', 'max_discount_percent', 'amount_in_stock', 'product_unit', 'pending_in', 'pending_out', 'normal_price', 'BARCODE', 'purchase_price', 'purchase_ref', 'ISBN', 'quantity'];

    public function gaurd_stock(){
        return $this->hasMany('App\GaurdStock','product_id');
    }

    public function InvoiceDetail(){
        return $this->hasMany('App\Sales\InvoiceDetailModel','product_id');
    }
    public function ReceiveDetail(){
        return $this->hasMany('App\Purchase\ReceiveDetailModel','product_id');
    }
    public static function select_all(){
        return DB::table('tb_product')
            ->limit(20)
            ->get();
	}

    public static function select_by_keyword($q){
        return DB::table('tb_product')
            ->where('product_name', 'like' , "%{$q}%" )
            ->orWhere('item_code', 'like' , "%{$q}%" )
            ->orWhere('product_code', 'like' , "%{$q}%" )
            ->orderBy('updated_at','desc')
            ->limit(20)
            ->get();
     }
    public static function select_by_id($id) {
        return DB::table('tb_product')
            ->where('product_id', '=', $id)
            ->limit(20)
            ->get();
    }
    public static function insert($input){
        return DB::table('tb_product')->insertGetId($input);
    }
    public static function update_by_id($input,$id) {
        DB::table('tb_product')
        ->where('product_id', $id)
        ->update($input);
    }
    public static function delete_by_id($id){
		DB::table('tb_product')
            ->where('product_id', '=', $id)
            ->delete();
	}
}
