<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountModel extends Model
{
    public static function select_all(){
		return DB::table('account')->get();
	}

	// function select_id($id){
	// 	$sql = "select * from account where id_account = {$id}";
	// 	return DB::select($sql, []);
	// }

	// function select_search($q){
	// 	$sql = "select * from account where id_account like %{$q}%";
	// 	return DB::select($sql, []);
	// }
}
