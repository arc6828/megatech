<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisitionModel extends Model
{
    protected $table = "tb_purchase_requisition";
    protected $primaryKey = 'purchase_requisition_id';
    protected $fillable = [];

    public function requisition_details()
    {
        return $this->hasMany('App\Purchase\RequisitionDetailModel','purchase_requisition_id');
    }
    public function RequisitionDetail()
    {
        return $this->hasMany('App\Purchase\RequisitionDetailModel','purchase_requisition_id');
    }
    public function User()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function Customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }

    
    public static function select_all(){
      //return DB::table('tb_purchase_requisition')
            return self::join('tb_customer', 'tb_purchase_requisition.customer_id', '=', 'tb_customer.customer_id')
          ->join('tb_delivery_type', 'tb_purchase_requisition.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
          ->join('tb_tax_type', 'tb_purchase_requisition.tax_type_id', '=', 'tb_tax_type.tax_type_id')
          ->join('tb_purchase_status', 'tb_purchase_requisition.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
          ->join('users', 'tb_purchase_requisition.user_id', '=', 'users.id')
          ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_purchase_requisition` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_purchase_requisition')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            ->where('purchase_status_id','!=','-1')
            ->count();
	}

	public static function select_by_id($id){
    return DB::table('tb_purchase_requisition')
      ->join('tb_customer', 'tb_purchase_requisition.customer_id', '=', 'tb_customer.customer_id')
      ->where('tb_purchase_requisition.purchase_requisition_id', '=' , $id )
			->select( DB::raw('tb_purchase_requisition.*, tb_customer.contact_name, tb_customer.company_name, tb_customer.customer_code'))
      ->get();
	}

	public static function select_by_keyword($q){
    return DB::table('tb_purchase_requisition')
      ->join('tb_customer', 'tb_purchase_requisition.customer_id', '=', 'tb_customer.customer_id')
      ->join('tb_delivery_type', 'tb_purchase_requisition.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
      ->join('tb_tax_type', 'tb_purchase_requisition.tax_type_id', '=', 'tb_tax_type.tax_type_id')
      ->join('tb_purchase_status', 'tb_purchase_requisition.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
      ->join('users', 'tb_purchase_requisition.user_id', '=', 'users.id')
 			->select( DB::raw(
 				'tb_purchase_requisition.*, tb_customer.contact_name, tb_customer.company_name, tb_customer.customer_code'
        ))
      ->get();
	}

	public static function insert($input){
    return DB::table('tb_purchase_requisition')->insertGetId($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_purchase_requisition')
        ->where('purchase_requisition_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
    DB::table('tb_purchase_requisition')
        ->where('purchase_requisition_id', '=', $id)
        ->delete();
	}


}
