<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
  protected $table = "users";
  protected $primaryKey = 'id';
  protected $fillable = [];







  public static function check_role($user_id, $role)
  {
    return DB::table('users')
      ->where("id", $user_id)
      ->where("role", $role)
      ->exists();
  }

  public static function select_all()
  {
    return DB::table('users')
      ->get();
  }

  public static function select_by_id($id)
  {
    return DB::table('users')
      ->where('users.id', '=', $id)
      ->get();
  }

  public static function select_by_name($q)
  {
    return DB::table('users')
      ->where('users.name', 'like', "%{$q}%")
      ->get();
  }

  public static function select_by_role($role)
  {
    return DB::table('users')
      ->join('tb_department', 'users.role', '=', 'tb_department.department_role')
      ->where('users.role', 'like', "%$role%")
      ->get();
  }

  public static function select_by_role_by_keyword($role, $q)
  {
    return DB::table('users')
      ->where('users.name', '=', $role)
      ->where('users.name', 'like', "%{$q}%")
      ->get();
  }
  public static function update_by_id($input, $id)
  {
    DB::table('users')->where('users.id', $id)->update($input);
  }
  public static function delete_by_id($id)
  {
    DB::table('users')->where('users.id', '=', $id)->delete();
  }
}
