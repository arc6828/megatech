<?php

namespace App;

use Illuminate\Support\Facades\DB;

class AccountModel 
{
     function select(){
		$sql = "select * from account ";
		return DB::select($sql, []);
	}

	function select_id($id){
		$sql = "select * from account where id_account = {$id_account}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from account where id_account like %{$q}%";
		return DB::select($sql, []);
	}
}
