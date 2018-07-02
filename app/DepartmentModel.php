<?php

namespace App;

use Illuminate\Support\Facades\DB;

class DepartmentModel
{
     function select(){
		$sql = "select * from department";
		return DB::select($sql, []);
	}

	function select_id($id_user){
		$sql = "select * from department where id_department = {$id_department}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from department where id_department like %{$q}%";
		return DB::select($sql, []);
	}
}