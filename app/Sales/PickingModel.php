<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class PickingModel extends Model
{
    protected $table = 'tb_sales_picking';
    protected $primaryKey = 'sales_picking_id';
    protected $fillable = ['picking_code', 'order_code', 'sales_picking_id', 'datetime', 'remark'];

    public function order()
    {
        return $this->belongsTo('App\Sales\OrderModel', 'order_code');
    }
    public function picking_details()
    {
        return $this->hasMany('App\Sales\PickingDetail', 'picking_code');
    }
}

// public static function insert($input)
// {
//     return DB::table('tb_sales_picking')->insertGetId($input);
// }

// public static function update_by_id($input, $id)
// {
//     DB::table('tb_sales_picking')
//         ->where('sales_picking_id', $id)
//         ->update($input);
// }

// public static function select_count_by_current_month()
// {
//     //SELECT count(*) FROM `tb_order` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
//     return DB::table('tb_sales_picking')
//         ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
//         ->count();
// }

/*
public static function select_all_by_user_id($user_id){
return DB::table('tb_order')
->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
->join('tb_delivery_type', 'tb_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
->join('tb_tax_type', 'tb_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
->join('users', 'tb_order.user_id', '=', 'users.id')
->where('tb_order.user_id', '=', $user_id)
->get();
}

public static function select_all(){
return DB::table('tb_order')
->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
->join('tb_delivery_type', 'tb_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
->join('tb_tax_type', 'tb_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
->join('users', 'tb_order.user_id', '=', 'users.id')
->get();
}

public static function select_count_by_current_month(){
//SELECT count(*) FROM `tb_order` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
return DB::table('tb_order')
->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
->count();
}

public static function select_by_id($id){
return DB::table('tb_order')
->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
->where('tb_order.order_id', '=' , $id )
->select( DB::raw('tb_order.*, tb_customer.company_name, tb_customer.customer_code'))
->get();
}

public static function select_by_keyword($q){
return DB::table('tb_order')
->join('tb_customer', 'tb_order.customer_id', '=', 'tb_customer.customer_id')
->join('tb_delivery_type', 'tb_order.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
->join('tb_tax_type', 'tb_order.tax_type_id', '=', 'tb_tax_type.tax_type_id')
->join('tb_sales_status', 'tb_order.sales_status_id', '=', 'tb_sales_status.sales_status_id')
->join('users', 'tb_order.user_id', '=', 'users.id')
->select( DB::raw(
'tb_order.*, tb_customer.contact_name'
))
->get();
}

public static function select_by_po($customer_id,$external_reference_id){
return DB::table('tb_order')
->where('customer_id', $customer_id )
->where('external_reference_id', $external_reference_id )
//->select( DB::raw('tb_order.*, tb_customer.contact_name, tb_customer.customer_code'))
->get();
}

public static function insert($input){
return DB::table('tb_order')->insertGetId($input);
}

public static function update_by_id($input, $id){
DB::table('tb_order')
->where('order_id', $id)
->update($input);
}

public static function delete_by_id($id){
DB::table('tb_order')
->where('order_id', '=', $id)
->delete();
}
 */
