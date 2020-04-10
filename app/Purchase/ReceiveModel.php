<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiveModel extends Model
{
    protected $table = 'tb_purchase_receive';
    protected $primaryKey = 'purchase_receive_id';
    protected $fillable = [
        'invoice_code',
        'datetime',
        'supplier_id',
        'debt_duration',
        'billing_duration',
        'payment_condition',
        'delivery_type_id',
        'tax_type_id',
        'delivery_time',
        'department_id',
        'purchase_status_id',
        'user_id',
        'zone_id',
        'remark',
        'vat_percent',
        'external_reference_id',
        'internal_reference_id',
        'total',
        'total_payment',
        'total_debt',
      ];

    
    public function ReceiveDetail()
    {   
        return $this->hasMany('App\Purchase\ReceiveDetailModel','purchase_receive_id');
    }

    public function supplier_billing_detail(){
        return $this->hasOne('App\SupplierBillingDetail','doc_id');
    }
    
    public function User()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function Customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }
    public function Supplier(){
        return $this->belongsTo('App\SupplierModel','supplier_id');
      }


    public static function select_all(){
      return DB::table('tb_purchase_receive')
          ->join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
          ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
          ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
          ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
          ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
          ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_purchase_receive` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_purchase_receive')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_receive')
      ->join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->where('tb_purchase_receive.purchase_receive_id', '=' , $id )
			->select( DB::raw('tb_purchase_receive.*, tb_supplier.company_name, tb_supplier.supplier_code'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_purchase_receive')
      ->join('tb_supplier', 'tb_purchase_receive.supplier_id', '=', 'tb_supplier.supplier_id')
      ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_purchase_receive.*, tb_supplier.contact_name'
        ))
      ->get();
	}

	public static function insert($input){
    return DB::table('tb_purchase_receive')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_receive')
        ->where('purchase_receive_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
    DB::table('tb_purchase_receive')
        ->where('purchase_receive_id', '=', $id)
        ->delete();
	}

}
