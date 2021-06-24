<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ReceiveTemporaryModel extends Model
{
  protected $table = 'tb_receive_temporary';
  protected $primaryKey = 'receive_temporary_id';
  protected $fillable = [
    'staff_id',
    'receive_temporary_code',
    'datetime',
    'supplier_id',
    'contact_name',
    'debt_duration',
    'billing_duration',
    'payment_condition',
    'receive_type_id',
    'tax_type_id',
    'receive_time',
    'department_id',
    'purchase_status_id',
    'user_id',
    'zone_id',
    'remark',
    'vat_percent',
    'internal_reference_doc',
    'external_reference_doc',
    'total',
    'revision',
  ];

  public function purchase_status()
  {
    return $this->belongsTo('App\PurchaseStatusModel', 'purchase_status_id');
  }

  public function staff()
  {
    return $this->belongsTo('App\User', 'staff_id');
  }

  public function receive_temporary_details()
  {
    return $this->hasMany('App\Purchase\ReceiveTemporaryDetailModel', 'receive_temporary_id');
  }

  // public static function select_all_by_user_id($user_id){
  //   return DB::table('tb_receive_temporary')
  //       ->join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
  //       ->join('tb_delivery_type', 'tb_receive_temporary.receive_type_id', '=', 'tb_delivery_type.delivery_type_id')
  //       ->join('tb_tax_type', 'tb_receive_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
  //       ->join('tb_purchase_status', 'tb_receive_temporary.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
  //       ->join('users', 'tb_receive_temporary.staff_id', '=', 'users.id')
  //       ->where('tb_receive_temporary.user_id', '=', $user_id)
  //       ->get();
  // }

  // public static function select_all(){
  //   return DB::table('tb_receive_temporary')
  //       ->join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
  //       ->join('tb_delivery_type', 'tb_receive_temporary.receive_type_id', '=', 'tb_delivery_type.delivery_type_id')
  //       ->join('tb_tax_type', 'tb_receive_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
  //       ->join('tb_purchase_status', 'tb_receive_temporary.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
  //       ->join('users', 'tb_receive_temporary.staff_id', '=', 'users.id')
  //       ->get();
  // }
  // public static function select_count_by_current_month(){
  //     //SELECT count(*) FROM `tb_receive_temporary` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
  //     return DB::table('tb_receive_temporary')
  //         ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
  //         ->where('purchase_status_id','!=','-1')
  //         ->count();
  // }

  // public static function select_by_id($id)
  // {
  //   return DB::table('tb_receive_temporary')
  //     ->join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
  //     ->where('tb_receive_temporary.receive_temporary_id', '=', $id)
  //     //->select( DB::raw('tb_receive_temporary.*, tb_supplier.contact_name'))
  //     ->select(DB::raw('tb_supplier.*,tb_receive_temporary.*'))
  //     ->get();
  // }

  // public static function select_by_keyword($q)
  // {
  //   return DB::table('tb_receive_temporary')
  //     ->join('tb_supplier', 'tb_receive_temporary.supplier_id', '=', 'tb_supplier.supplier_id')
  //     ->join('tb_delivery_type', 'tb_receive_temporary.receive_type_id', '=', 'tb_delivery_type.delivery_type_id')
  //     ->join('tb_tax_type', 'tb_receive_temporary.tax_type_id', '=', 'tb_tax_type.tax_type_id')
  //     ->join('tb_purchase_status', 'tb_receive_temporary.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
  //     ->join('users', 'tb_receive_temporary.user_id', '=', 'users.id')
  //     ->select(DB::raw(
  //       'tb_receive_temporary.*, tb_supplier.contact_name'
  //     ))
  //     ->get();
  // }

  // public static function insert($input)
  // {
  //   return DB::table('tb_receive_temporary')->insertGetId($input);
  // }

  // public static function update_by_id($input, $id)
  // {
  //   DB::table('tb_receive_temporary')
  //     ->where('receive_temporary_id', $id)
  //     ->update($input);
  // }

  // public static function delete_by_id($id)
  // {
  //   DB::table('tb_receive_temporary')
  //     ->where('receive_temporary_id', '=', $id)
  //     ->delete();
  // }
}
