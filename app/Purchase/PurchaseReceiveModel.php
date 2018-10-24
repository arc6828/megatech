<?php

namespace App\Purchase;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/*
use App\CustomerModel;
use App\DeliveryTypeModel;
use App\TaxTypeModel;
use App\SalesStatusModel;
use App\UserModel;
use App\ZoneModel;
*/

class PurchaseReceiveModel extends Model
{
    public static function select_all(){
		$total_query = DB::table('tb_purchase_receive_detail')
            ->select( DB::raw('purchase_receive_id, sum(discount_price) as total'))
            ->groupBy('purchase_receive_id');
        return DB::table('tb_purchase_receive')
            ->join('tb_customer', 'tb_purchase_receive.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
            ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_purchase_receive.purchase_receive_id', '=', 'total_query.purchase_receive_id');
			})
			->select( DB::raw('*, (vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}
    public static function select_count_by_current_month(){
        //SELECT count(*) FROM `tb_purchase_receive` WHERE month(datetime) = month(now()) and year(datetime) = year(now())
        return DB::table('tb_purchase_receive')
            ->whereRaw('month(datetime) = month(now()) and year(datetime) = year(now())', [])
            //->where('month(datetime)', 'month(now())')
            //->where('year(datetime)', 'year(now())')
            ->count();
	}

	public static function select_by_id($id){
		$total_query = DB::table('tb_purchase_receive_detail')
             ->select( DB::raw('purchase_receive_id, sum(discount_price) as total'))
             ->groupBy('purchase_receive_id');
        return DB::table('tb_purchase_receive')
			->leftJoinSub($total_query, 'total_query', function($join) {
				$join->on('tb_purchase_receive.purchase_receive_id', '=', 'total_query.purchase_receive_id');
			})
            ->where('tb_purchase_receive.purchase_receive_id', '=' , $id )
			->select( DB::raw('*, (vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
            ->get();
	}

	public static function select_by_keyword($q){
      //SELECT * FROM `tb_purchase_receive`
      //Left JOIN ( SELECT sum(discount_price) as total_discount_price , purchase_receive_id FROM `tb_purchase_receive_detail` GROUP BY purchase_receive_id ) q
      //on `tb_purchase_receive`.`purchase_receive_id` = q.purchase_receive_id

        $total_query = DB::table('tb_purchase_receive_detail')
             ->select( DB::raw('purchase_receive_id, sum(discount_price) as total'))
             ->groupBy('purchase_receive_id');
        return DB::table('tb_purchase_receive')
            ->join('tb_customer', 'tb_purchase_receive.customer_id', '=', 'tb_customer.customer_id')
            ->join('tb_delivery_type', 'tb_purchase_receive.delivery_type_id', '=', 'tb_delivery_type.delivery_type_id')
            ->join('tb_tax_type', 'tb_purchase_receive.tax_type_id', '=', 'tb_tax_type.tax_type_id')
            ->join('tb_purchase_status', 'tb_purchase_receive.purchase_status_id', '=', 'tb_purchase_status.purchase_status_id')
            ->join('users', 'tb_purchase_receive.user_id', '=', 'users.id')
            ->leftJoinSub($total_query, 'total_query', function($join) {
                $join->on('tb_purchase_receive.purchase_receive_id', '=', 'total_query.purchase_receive_id');
            })
            ->where('purchase_receive_code', 'like' , "%{$q}%" )
            ->orWhere('company_name', 'like' , "%{$q}%" )
            ->orWhere('customer_name', 'like' , "%{$q}%" )
            ->orWhere('purchase_status_name', 'like' , "%{$q}%" )
			->select( DB::raw('*, (vat_percent/100*total) as vat, ((100+vat_percent)/100*total) as total_after_vat'))
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

	public static function select_customer($q) {
		$sql = "select tb_purchase_receive.id, tb_purchase_receive.id_dept, tb_purchase_receive.date_dept, tb_purchase_receive.total, tb_purchase_receive.id_customer, customer.name_company
			from tb_purchase_receive inner join customer on tb_purchase_receive.id_customer = customer.id_customer
			where tb_purchase_receive.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
