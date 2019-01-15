<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DebtoutModel extends Model
{
	public static function select_tb_tax(){
		return DB::table('tb_tax_type')->get();
	}
	public static function select_all(){
		return DB::table('tb_debtout')
		->join('tb_customer','tb_debtout.customer_id','=','tb_customer.customer_id')
		->get();
	}
	public static function select_search($q) {
		$sql = "select tb_debtout.*, tb_customer.* from tb_debtout 
				inner join tb_customer on 
				tb_debtout.customer_id = tb_customer.customer_id 
				where tb_debtout.debt_code like '%{ $q }%'";
		return DB::select($sql,[]);
	}
	public static function insert($input){
		return DB::table('tb_debtout')->insertGetId($input);
	}
	public static function select_by_id($id) {
		return DB::table('tb_debtout')
		->where('debt_id', $id)
		->get();
	}
	public static function update_by_id($input,$id) {
		DB::table('tb_debtout')
		->where('tb_debtout.debt_id',$id)
		->update($input);
	}
	public static function delete_by_id($id) {
		DB::table('tb_debtout')
		->where('tb_debtout.debt_id','=', $id)
		->delete();
	}
    // function select(){
	// 	$sql = "select * from debtout";
	// 	return DB::select($sql, []);
	// }
	// function select_tb_tax(){
	// 	$sql = "select * from tb_tax_type";
	// 	return DB::select($sql,[]);
	// }
	// function select_id($id){
	// 	$sql = "select * from debtout where id = {$id}";
	// 	return DB::select($sql, []);
	// }

	// function select_search($q){
	// 	$sql = "select * from debtout where id_dept like '%{$q}%'";
	// 	return DB::select($sql, []);
	// }

	// function insert($id_dept, $id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total){
	// 	$sql = "insert into debtout (id_dept, id_customer, type_tax, tax_liability, date_dept, deadline, tax_filing, total_dept, tax_value, tax, total) 
	// 			values ('{$id_dept}','{$id_customer}', '{$type_tax}', '{$tax_liability}', '{$date_dept}', '{$deadline}', '{$tax_filing}', {$total_dept}, {$tax_value}, {$tax}, {$total})";
	// 	DB::insert($sql, []);
	// }

	// function update($id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total, $id){
	// 	$sql = "update debtout set 
	// 			id_customer = '{$id_customer}', type_tax = '{$type_tax}',  
	// 			tax_liability =  '{$tax_liability}', date_dept =  '{$date_dept}',
	// 			deadline = '{$deadline}', tax_filing = '{$tax_filing}', total_dept = {$total_dept},
	// 			tax_value = {$tax_value}, tax = {$tax}, total = {$total}
	// 			where id = {$id}";
	// 	DB::update($sql, []);
	// }

	// function delete($id){
	// 	$sql = "delete from debtout where id = {$id}";
	// 	DB::delete($sql, []);
	// }
	// function select_customer($q) {
	// 	$sql = "select debtout.id, debtout.id_dept, debtout.date_dept, debtout.total, debtout.id_customer, tb_customer.company_name
	// 		from debtout inner join tb_customer on debtout.id_customer = tb_customer.customer_id
	// 		where debtout.id_dept like '%{$q}%'";
	// 	return DB::select($sql, []);
	// }
}
