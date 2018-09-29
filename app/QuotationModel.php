<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationModel extends Model
{
    public static function select_all(){
        return DB::table('tb_quotation')->get();
	}

	public static function select_by_id($id){
        return DB::table('tb_quotation')
            ->where('quotation_id', '=' , $id )
            ->get();
	}

	public static function select_by_keyword($q){
        return DB::table('tb_quotation')
            ->where('quotation_id', 'like' , "%{$q}%" )
            ->get();
	}

	public static function insert($input){
        DB::table('tb_quotation')->insert($input);
	}

	public static function update_by_id($input, $id){
        DB::table('tb_quotation')
            ->where('quotation_id', $id)
            ->update($input);
	}

	public static function delete_by_id($id){
        DB::table('tb_quotation')
            ->where('quotation_id', '=', $id)
            ->delete();
	}

	public static function select_customer($q) {
		$sql = "select tb_quotation.id, tb_quotation.id_dept, tb_quotation.date_dept, tb_quotation.total, tb_quotation.id_customer, customer.name_company
			from tb_quotation inner join customer on tb_quotation.id_customer = customer.id_customer
			where tb_quotation.id_dept like '%{$q}%'";
		return DB::select($sql, []);
	}
}
