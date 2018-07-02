<?php

namespace App;

use Illuminate\Support\Facades\DB;

class SettleModel
{
   function select(){
		$sql = "select * from settle";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from settle where id = {$id}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from settle where name like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_settle, $id_customer, $type_tax, $id_user, $id_department, $sale_area, $tax_liability, $date_settle, $debt_period, $deadline_settle, $id_job, $ref_number, $tax_filing, $id_account, $total_settle, $id_deposit, $discount, $total_deposit, $tax, $tax_value, $cash_receipt, $total){
		$sql = "insert into settle (id_settle,id_customer,type_tax,id_user,id_department,sale_area,tax_liability,date_settle,debt_period,deadline_settle,id_job,ref_number,tax_filing,id_account,total_settle,id_deposit,discount,total_deposit,tax,tax_value,cash_receipt,total) 
				values ( '{$id_settle}', '{$id_customer}', '{$type_tax}', '{$id_user}', '{$id_department}', '{$sale_area}', '{$tax_liability}', '{$date_settle}', {$debt_period}, '{$deadline_settle}', '{$id_job}', '{$ref_number}', '{$tax_filing}', {$id_account}, {$total_settle}, '{$id_deposit}', '{$discount}', {$total_deposit}, {$tax}, {$tax_value}, {$cash_receipt}, {$total})";
		DB::insert($sql, []);
	}

	function update($name, $age, $address, $salary, $id){
		$sql = "update settle set 
				name = '{$name}', age = {$age},  
				address =  '{$address}', salary =  {$salary}
				where id = {$id}";
		DB::update($sql, []);
	}

	function delete($id){
		$sql = "delete from settle where id = {$id}";
		DB::delete($sql, []);
	}
}
