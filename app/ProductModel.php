<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    protected $table = "tb_product";
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_code', 'product_name', 'product_detail', 'brand', 'promotion_price', 'floor_price', 'max_discount_percent', 'amount_in_stock', 'product_unit', 'pending_in', 'pending_out', 'normal_price', 'BARCODE', 'purchase_price', 'purchase_ref', 'ISBN', 'quantity','stock'];

    public function product_details(){
        return $this->hasMany('App\ProductDetail','final_product_id','product_id');
    }

    public function gaurd_stock(){
        return $this->hasMany('App\GaurdStock','product_id');
    }

    public function InvoiceDetail(){
        return $this->hasMany('App\Sales\InvoiceDetailModel','product_id');
    }
    public function invoiceDetails(){
        return $this->hasMany('App\Sales\InvoiceDetailModel','product_id')
            ->join('tb_invoice','tb_invoice.invoice_id','tb_invoice_detail.invoice_id');
    }
    public function invoiceDetails_by_month($month){
        return $this->hasMany('App\Sales\InvoiceDetailModel','product_id')
            ->join('tb_invoice','tb_invoice.invoice_id','tb_invoice_detail.invoice_id')
            ->whereMonth('datetime',$month);
    }
    public function ReceiveDetail(){
        return $this->hasMany('App\Purchase\ReceiveDetailModel','product_id');
    }
    public static function select_all(){
        return DB::table('tb_product')
            ->orderBy('amount_in_stock','desc')
            ->limit(100)
            ->get();
	}

    public static function select_by_keyword($q){
        $query = DB::table('tb_product')
        ->where('product_name', 'like' , "%{$q}%" )
        ->orWhere('item_code', 'like' , "%{$q}%" )
        ->orWhere('product_code', 'like' , "%{$q}%" )
        ->orderBy('amount_in_stock','desc');
        if($query->count() < 500){
            return $query
            ->get();
        }else{
            return $query
            ->limit(500)
            ->get();

        }
        
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
