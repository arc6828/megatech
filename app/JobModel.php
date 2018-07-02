<?php

namespace App;

use Illuminate\Support\Facades\DB;

class JobModel
{
     function select(){
		$sql = "select * from job";
		return DB::select($sql, []);
	}

	function select_id($id_user){
		$sql = "select * from job where id_job = {$id_job}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from job where id_job like %{$q}%";
		return DB::select($sql, []);
	}
}