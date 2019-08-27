<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BillingNoteModel extends Model
{
    public static function select_all() {
        return DB::table('tb_billing_note')
        ->join('tb_customer','tb_billing_note.customer_id','=','tb_customer.customer_id')
        ->get();
    }
    public static function select_by_keyword($q) {
        return DB::table('tb_billing_note')
        ->join('tb_customer','tb_billing_note.customer_id','=','tb_customer.customer_id')
        ->where('billing_note_code', 'like', "%{ $q }%")
        ->get();
    }
    public static function insert($input) {
        return DB::table('tb_billing_note')->insertGetId($input);
    }
    public static function update_by_id($input,$id) {
        DB::table('tb_billing_note')
        ->where('tb_billing_note.billing_note_id',$id)
        ->update($input);
    }
    public static function select_by_id($id) {
        return DB::table('tb_billing_note')
        ->where('tb_billing_note.billing_note_id','=',$id)
        ->get();
    }
    public static function delete_by_id($id) {
         DB::table('tb_billing_note')
        ->where('tb_billing_note.billing_note_id','=',$id)
        ->delete();
    }
}
