<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaxTypeModel extends Model
{
    public static function select_all(){
        return DB::table('tb_tax_type')->get();
	}
}
