<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationDetailModel extends Model
{
    public static function select(){
		return DB::table('tb_quotation_detail')->get();
	}

	public static function select_by_quotation_id($quotation_id){
        return DB::table('tb_quotation_detail')
            ->where('quotation_id', '=' , $quotation_id )
            ->get();
	}
}
