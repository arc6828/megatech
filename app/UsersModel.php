<?php

namespace App;

use Illuminate\Support\Facades\DB;

class UsersModel
{
    function select(){
		$sql = "select * from users";
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

	function select_by_role_search($role, $q){
		$sql = "select * from users where role = '{$role}' and name like '%{$q}%'";
		return DB::select($sql, []);
	}
}
