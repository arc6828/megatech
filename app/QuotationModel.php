<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationModel //extends Model
{
    function select(){
		$sql = "select * from tb_quotation";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from tb_quotation where quotation_id = {$id}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from tb_quotation where id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_dept, $id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total){
		$sql = "insert into tb_quotation (id_dept, id_customer, type_tax, tax_liability, date_dept, deadline, tax_filing, total_dept, tax_value, tax, total) 
				values ('{$id_dept}','{$id_customer}', '{$type_tax}', '{$tax_liability}', '{$date_dept}', '{$deadline}', '{$tax_filing}', {$total_dept}, {$tax_value}, {$tax}, {$total})";
		DB::insert($sql, []);
	}

	function update($id_customer, $type_tax, $tax_liability, $date_dept, $deadline, $tax_filing, $total_dept, $tax_value, $tax, $total, $id){
		$sql = "update tb_quotation set 
				id_customer = '{$id_customer}', type_tax = '{$type_tax}',  
				tax_liability =  '{$tax_liability}', date_dept =  '{$date_dept}',
				deadline = '{$deadline}', tax_filing = '{$tax_filing}', total_dept = {$total_dept},
				tax_value = {$tax_value}, tax = {$tax}, total = {$total}
				where id = {$id}";
		DB::update($sql, []);
	}

	function delete($id){
		$sql = "delete from tb_quotation where id = {$id}";
		DB::delete($sql, []);
	}
	function select_customer($q) {
		$sql = "select tb_quotation.id, tb_quotation.id_dept, tb_quotation.date_dept, tb_quotation.total, tb_quotation.id_customer, customer.name_company
			from tb_quotation inner join customer on tb_quotation.id_customer = customer.id_customer
			where tb_quotation.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
