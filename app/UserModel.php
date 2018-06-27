<?php

namespace App;

use Illuminate\Support\Facades\DB;

class UserModel
{
     function select(){
		$sql = "select * from user";
		return DB::select($sql, []);
	}

	function select_id($id_user){
		$sql = "select * from user where id_user = {$id_user}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from account where id_user like %{$q}%";
		return DB::select($sql, []);
	}
}
