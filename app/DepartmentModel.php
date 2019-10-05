<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DepartmentModel extends Model
{
  	protected $table = "tb_department";
	protected $primaryKey = 'department_id';
	protected $fillable = [];
  
	public static function select_all(){
		return DB::table('tb_department')->get();
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
