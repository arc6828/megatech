<?php

namespace App;

use Illuminate\Support\Facades\DB;

class CustomerModel 
{
     function select(){
		$sql = "select * from customer ";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from customer where id = {$id}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from customer where id_customer like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_customer ,$type_customer, $name_company, $id_account, $name_customer, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number){
		$sql = "insert into customer (id_customer, type_customer, name_company, id_account, name_customer, address, place_delivery, id_user, telephone, sales_area, transpot, note, credit, debt_period, degree_product, deposit_discount, tax_number, bill_condition, check_condition, location, branch, fax_number) 
			values('{$id_customer}', '{$type_customer}', '{$name_company}', {$id_account}, '{$name_customer}', '{$address}', '{$place_delivery}', {$id_user}, '{$telephone}', '{$sales_area}', '{$transpot}', '{$note}', {$credit}, {$debt_period}, {$degree_product}, {$deposit_discount}, {$tax_number}, '{$bill_condition}', '{$check_condition}', '{$location}', '{$branch}', '{$fax_number}')";
		DB::insert($sql, []);
	}

	function update($type_customer, $name_company, $id_account, $name_customer, $address,$place_delivery, $id_user, $telephone, $sales_area, $transpot, $note,$credit, $debt_period, $degree_product, $deposit_discount, $tax_number, $bill_condition, $check_condition,$location, $branch, $fax_number, $id){
		$sql = "update customer set 
				 type_customer = '{$type_customer}', name_company = '{$name_company}', id_account = {$id_account}, name_customer = '{$name_customer}', address = '{$address}', place_delivery = '{$place_delivery}', id_user = {$id_user}, telephone = '{$telephone}', sales_area = '{$sales_area}', transpot = '{$transpot}', note = '{$note}', credit = {$credit}, debt_period = {$debt_period}, degree_product = {$degree_product}, deposit_discount = {$deposit_discount}, tax_number = '{$tax_number}', bill_condition = '{$bill_condition}', check_condition = '{$check_condition}', location = '{$location}', branch = '{$branch}', fax_number = '{$fax_number}'
				where id = {$id}";
		DB::update($sql, []);
	}

	function delete($id){
		$sql = "delete from customer where id = {$id}";
		DB::delete($sql, []);
	}

}
