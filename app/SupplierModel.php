<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SupplierModel extends Model
{
    public static function select_all(){
        return DB::table('tb_supplier')->get();
    }
    public static function select_by_name($q) {
        return DB::table('tb_supplier')->where('supplier_code', 'like', "%{$q}%")->get();
    }
    public static function select_by_id($id) {
        return DB::table('tb_supplier')->where('supplier_id', '=', $id)->get();
    }
    public static function select_location_type() {
		return DB::table('tb_location_type')->get();
    }
    public static function select_delivery_type() {
		return DB::table('tb_delivery_type')->get();
	}
    public static function insert($input) {
        return DB::table('tb_supplier')->insertGetId($input);
    }
    public static function update_all($input,$id) {
         DB::table('tb_supplier')->where('supplier_id',$id)->update($input);
    }
    public static function delete_by_id($id) {
        DB::table('tb_supplier')
        ->where('supplier_id', '=', $id)
        ->delete();
    }
}
