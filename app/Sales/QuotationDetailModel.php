<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationDetailModel extends Model
{
  protected $table = "tb_quotation_detail";
  protected $primaryKey = 'quotation_detail_id';
  protected $fillable = [];

  public static function select_all(){
		return DB::table('tb_quotation_detail')
      ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
      ->join('tb_quotation','tb_quotation_detail.quotation_id','=','tb_quotation.quotation_id')
      ->get();
	}

	public static function select_by_quotation_id($quotation_id){
    return DB::table('tb_quotation_detail')
        ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
        ->where('quotation_id', '=' , $quotation_id )
        ->get();
	}

  public static function select_by_customer_id($customer_id){
    return DB::table('tb_quotation_detail')
        ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
        ->join('tb_quotation','tb_quotation_detail.quotation_id','=','tb_quotation.quotation_id')
        ->where('customer_id', '=' , $customer_id )
        ->get();
	}

  public static function select_by_user_id($customer_id,$user_id){
    return DB::table('tb_quotation_detail')
        ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
        ->join('tb_quotation','tb_quotation_detail.quotation_id','=','tb_quotation.quotation_id')
        ->where('user_id', '=' , $user_id )
        ->where('customer_id', '=' , $customer_id )
        ->get();
	}

	public static function select_by_id($id){
    return DB::table('tb_quotation_detail')
        ->join('tb_product','tb_quotation_detail.product_id','=','tb_product.product_id')
        ->where('quotation_detail_id', '=' , $id )
        ->get();
	}

  public static function insert($input){
    DB::table('tb_quotation_detail')->insert($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_quotation_detail')
        ->where('quotation_detail_id', $id)
        ->update($input);
	}

  public static function update_key_by_id($key, $input, $id){
    DB::table('tb_quotation_detail')
        ->where('quotation_detail_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_quotation_detail')
            ->where('quotation_detail_id', '=', $id)
            ->delete();
	}

  public static function delete_by_quotation_id($quotation_id){
		DB::table('tb_quotation_detail')
        ->where('quotation_id', '=', $quotation_id)
        ->delete();
	}
}
