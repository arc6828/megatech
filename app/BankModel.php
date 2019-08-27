<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankModel extends Model
{
    public static function select_all() {
        return DB::table('tb_bank')->get();
    }
    public static function select_by_name($q) {
        return DB::table('tb_bank')->where('tb_bank.bank_code' ,'like',"%{$q}%")->get();
    }
    public static function select_by_id($id) {
        return DB::table('tb_bank')->where('tb_bank.bank_id', '=', $id)->get();
    }
    public static function insert($input) {
        return DB::table('tb_bank')->insertGetId($input);
    }
    public static function update_by_id($input,$id) {
         DB::table('tb_bank')->where('bank_id', $id)->update($input);
    }
    public static function delete_by_id($id) {
        DB::table('tb_bank')->where('bank_id','=',$id)->delete();
    }
}
