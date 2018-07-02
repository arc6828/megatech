<?php

namespace App;

use Illuminate\Support\Facades\DB;

class DepositModel
{
     function select(){
		$sql = "select * from deposit";
		return DB::select($sql, []);
	}

	function select_id($id_user){
		$sql = "select * from deposit where id_deposit = {$id_deposit}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from deposit where id_deposit like %{$q}%";
		return DB::select($sql, []);
	}
}