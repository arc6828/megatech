<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InventoryModel extends Model
{
    protected $table = 'tb_inventory';
    protected $primaryKey = 'inventory_id';
    protected $fillable = [];

    public static function select_all() {
        return DB::table('tb_inventory')->get();
    }
    public static function select_by_id($id) {
        return DB::table('tb_inventory')->where('tb_inventory.inventory_id','=',$id)->get();
    }
    public static function select_by_name($q) {
        return DB::table('tb_inventory')->where('tb_inventory.inventory_name','like', "%{$q}%")->get();
    }
    public static function insert($input) {
        return DB::table('tb_inventory')->insertGetId($input);
    }
    public static function update_by_id($input,$id) {
         DB::table('tb_inventory')->where('tb_inventory.inventory_id',$id)->update($input);
    }
    public static function delete_by_id($id) {
         DB::table('tb_inventory')->where('tb_inventory.inventory_id','=',$id)->delete();
    }
}
