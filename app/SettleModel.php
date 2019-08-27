<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SettleModel extends Model
{

	public static function select_customer($q) {
		return	DB::table('tb_settle')
		->join('tb_customer','tb_settle.customer_id','=','tb_customer.customer_id')
		->where('settle_code','like', "%{ $q }%")
		->get();
	}
	public static function select_all_tax(){
		return DB::table('tb_tax_type')->get();
	}
//    function select(){
// 		$sql = "select * from settle";
// 		return DB::select($sql, []);
// 	}

// 	function select_id($id){
// 		$sql = "select * from settle where id = {$id}";
// 		return DB::select($sql, []);
// 	}

// 	function select_search($q){
// 		$sql = "select * from settle where name like '%{$q}%'";
// 		return DB::select($sql, []);
// 	}

// 	function insert($id_settle, $id_customer, $type_tax, $id_user, $id_department, $sale_area, $tax_liability, $date_settle, $debt_period, $deadline_settle, $id_job, $ref_number, $tax_filing, $id_account, $total_settle, $id_deposit, $discount, $total_deposit, $tax, $tax_value, $cash_receipt, $total){
// 		$sql = "insert into settle (id_settle,id_customer,type_tax,id_user,id_department,sale_area,tax_liability,date_settle,debt_period,deadline_settle,id_job,ref_number,tax_filing,id_account,total_settle,id_deposit,discount,total_deposit,tax,tax_value,cash_receipt,total) 
// 				values ( '{$id_settle}', '{$id_customer}', '{$type_tax}', '{$id_user}', '{$id_department}', '{$sale_area}', '{$tax_liability}', '{$date_settle}', {$debt_period}, '{$deadline_settle}', '{$id_job}', '{$ref_number}', '{$tax_filing}', {$id_account}, {$total_settle}, '{$id_deposit}', '{$discount}', {$total_deposit}, {$tax}, {$tax_value}, {$cash_receipt}, {$total})";
// 		DB::insert($sql, []);
// 	}

// 	function update($id_customer, $type_tax, $id_user, $id_department, $sale_area, $tax_liability, $date_settle, $debt_period, $deadline_settle, $id_job, $ref_number, $tax_filing, $id_account, $total_settle, $id_deposit, $discount, $total_deposit, $tax, $tax_value, $cash_receipt, $total, $id){
// 		$sql = "update settle set 
// 				id_customer = '{$id_customer}', type_tax = '{$type_tax}', id_user = '{$id_user}', id_department = '{$id_department}', sale_area = '{$sale_area}', tax_liability = '{$tax_liability}', date_settle = '{$date_settle}', debt_period = '{$debt_period}', deadline_settle = '{$deadline_settle}', id_job = '{$id_job}', ref_number = '{$ref_number}', tax_filing = '{$tax_filing}', id_account = {$id_account}, total_settle = {$total_settle}, id_deposit = '{$id_deposit}', discount = '{$discount}', total_deposit = {$total_deposit}, tax = {$tax}, tax_value = {$tax_value}, cash_receipt = {$cash_receipt}, total = {$total}
// 				where id = {$id}";
// 		DB::update($sql, []);
// 	}

// 	function delete($id){
// 		$sql = "delete from settle where id = {$id}";
// 		DB::delete($sql, []);
// 	}
// 	function select_customer($q) {
// 		$sql = "select settle.id, settle.id_settle, settle.date_settle, (settle.total - settle.cash_receipt) as total1, settle.id_customer, customer.name_company, settle.total
// 			from settle inner join customer on settle.id_customer = customer.id_customer
// 			where settle.id_settle like '%{$q}%'";
// 		return DB::select($sql, []);
// 	}
}
