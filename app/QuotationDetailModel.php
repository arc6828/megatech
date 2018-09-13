<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationDetailModel //extends Model
{
    function select(){
		$sql = "select * from tb_quotation_detail";
		return DB::select($sql, []);
	}

	function select_quotation_id($id){
		$sql = "select * from tb_quotation_detail where quotation_id = {$id}";
		return DB::select($sql, []);
	}
}
