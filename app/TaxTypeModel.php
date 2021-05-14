<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaxTypeModel extends Model
{
    protected $table = "tb_tax_type";
    protected $primaryKey = 'tax_type_id';
    protected $fillable = [];

    public static function select_all()
    {
        return DB::table('tb_tax_type')->get();
    }
}
