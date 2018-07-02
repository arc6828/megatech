<?php

namespace App;

use Illuminate\Support\Facades\DB;

class DebtoutModel
{
    function select(){
		$sql = "select * from debtout";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from debtout where id = {$id}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from debtout where id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_dept, $id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total){
		$sql = "insert into debtout (id_dept, id_customer, type_tax, tax_liability, date_dept, deadline, tax_filing, total_dept, tax_value, tax, total) 
				values ('{$id_dept}','{$id_customer}', '{$type_tax}', '{$tax_liability}', '{$date_dept}', '{$deadline}', '{$tax_filing}', {$total_dept}, {$tax_value}, {$tax}, {$total})";
		DB::insert($sql, []);
	}

	function update($id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total, $id){
		$sql = "update debtout set 
				id_customer = '{$id_customer}', type_tax = '{$type_tax}',  
				tax_liability =  '{$tax_liability}', date_dept =  '{$date_dept}',
				deadline = '{$deadline}', tax_filing = '{$tax_filing}', total_dept = {$total_dept},
				tax_value = {$tax_value}, tax = {$tax}, total = {$total}
				where id = {$id}";
		DB::update($sql, []);
	}

	function delete($id){
		$sql = "delete from debtout where id = {$id}";
		DB::delete($sql, []);
	}
	function select_customer($q) {
		$sql = "select debtout.id, debtout.id_dept, debtout.date_dept, debtout.total, debtout.id_customer, customer.name_company
			from debtout inner join customer on debtout.id_customer = customer.id_customer
			where debtout.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
