<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZoneModel extends Model
{
    protected $table = "tb_zone";
    protected $primaryKey = 'zone_id';
    protected $fillable = [];

    public static function select_all(){
        return DB::table('tb_zone')->get();
	}
}
