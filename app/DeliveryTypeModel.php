<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryTypeModel extends Model
{
    protected $table = 'tb_delivery_type';
    protected $primaryKey = 'delivery_type_id';
    protected $fillable = [];

    public static function select_all(){
        return DB::table('tb_delivery_type')->get();
	}
}
