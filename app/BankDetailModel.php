<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankDetailModel extends Model
{
    public static function select_all() {
        return DB::table('tb_bank_detail')->get();
    }
    public static function select_year_now() {
        return DB::table('tb_bank_detail')
        ->where('tb_bank_detail.m_date', 'like', '2018%')
        ->get();
    }
}
