<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountModel extends Model
{
	protected $table = 'tb_account';
    protected $primaryKey = 'account_id';
    protected $fillable = [];

    public static function select_all(){
  		return DB::table('tb_account')->get();
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
