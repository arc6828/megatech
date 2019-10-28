<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    protected $table = "tb_purchase_order";
    protected $primaryKey = 'purchase_order_id';
    protected $fillable = [];

    
      public function OrderDetail(){
        return $this->hasMany('App\Purchase\OrderDetailModel','purchase_order_id');
      }
      public function User()
      {
          return $this->belongsTo('App\User','user_id');
      }
      public function Customer(){
        return $this->belongsTo('App\CustomerModel','customer_id');
      }
      public function Supplier(){
        return $this->belongsTo('App\SupplierModel','supplier_id');
      }


    public static function select_all(){
      return DB::table('tb_purchase_order')
          ->join('tb_supplier', 'tb_purchase_order.supplier_id', '=', 'tb_supplier.supplier_id')
          ->join('tb_delivery_type', 'tb_purchase_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
          ->join('tb_tax_type', 'tb_purchase_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
          ->join('tb_purchase_status', 'tb_purchase_order.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
          ->join('users', 'tb_purchase_order.user_id', '=', 'users.id')
          ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_purchase_order` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_purchase_order')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_order')
      ->join('tb_supplier', 'tb_purchase_order.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_purchase_order.purchase_order_id', '=' , $id )
			->select( DB::raw('tb_purchase_order.*, tb_supplier.company_name, tb_supplier.supplier_code'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_purchase_order')
      ->join('tb_supplier', 'tb_purchase_order.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_delivery_type', 'tb_purchase_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_purchase_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_purchase_status', 'tb_purchase_order.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_purchase_order.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_purchase_order.*, tb_supplier.contact_name'
        ))
      ->get();
	}

	public static function insert($input){
    return DB::table('tb_purchase_order')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_order')
        ->where('purchase_order_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
    DB::table('tb_purchase_order')
        ->where('purchase_order_id', '=', $id)
        ->delete();
	}

}
