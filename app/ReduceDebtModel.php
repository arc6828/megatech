<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReduceDebtModel extends Model
{
    public static function select_by_name($q) {
        return DB::table('tb_reduce_debt')
        ->where('reduce_code','like',"%{$q}%")
        ->get();
    }
    public static function select_tax_type() {
        return DB::table('tb_tax_type')
        ->get();
    }
    public static function select_zone() {
        return DB::table('tb_zone')->get();
    }
    public static function select_by_id($id) {
        return DB::table('tb_reduce_debt')
        ->where('reduce_id','=',$id)
        ->get();
    }
}
