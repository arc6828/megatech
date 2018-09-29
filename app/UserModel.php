<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public static function select_all(){
        return DB::table('users')
            ->get();
	}

	public static function select_by_id($id){
        return DB::table('users')
            ->where('users.id', '=' , $id )
            ->get();
	}

	public static function select_by_name($q){
        return DB::table('users')
            ->where('users.name', 'like' , "%{$q}%" )
            ->get();
	}

    public static function select_by_role($role){
        return DB::table('users')
            ->where('users.role', '=' , $role )
            ->get();
	}

	public static function select_by_role_by_keyword($role, $q){
        return DB::table('users')
            ->where('users.name', '=' , $role )
            ->where('users.name', 'like' , "%{$q}%" )
            ->get();
	}
}
