<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiveTemporaryDetailModel extends Model
{
  protected $table = "tb_receive_temporary_detail";
  protected $primaryKey = 'receive_temporary_detail_id';
  protected $fillable = [];

  public static function select_all(){
		return DB::table('tb_receive_temporary_detail')
      ->join('tb_product','tb_receive_temporary_detail.product_id','=','tb_product.product_id')
      ->join('tb_receive_temporary','tb_receive_temporary_detail.receive_temporary_id','=','tb_receive_temporary.receive_temporary_id')
      ->get();
	}

	public static function select_by_receive_temporary_id($receive_temporary_id){
    return DB::table('tb_receive_temporary_detail')
        ->join('tb_product','tb_receive_temporary_detail.product_id','=','tb_product.product_id')
        ->where('receive_temporary_id', '=' , $receive_temporary_id )
        ->get();
	}

  public static function select_by_supplier_id($supplier_id){
    return DB::table('tb_receive_temporary_detail')
        ->join('tb_product','tb_receive_temporary_detail.product_id','=','tb_product.product_id')
        ->join('tb_receive_temporary','tb_receive_temporary_detail.receive_temporary_id','=','tb_receive_temporary.receive_temporary_id')
        ->where('supplier_id', '=' , $supplier_id )
        ->get();
	}

  public static function select_by_user_id($supplier_id,$user_id){
    return DB::table('tb_receive_temporary_detail')
        ->join('tb_product','tb_receive_temporary_detail.product_id','=','tb_product.product_id')
        ->join('tb_receive_temporary','tb_receive_temporary_detail.receive_temporary_id','=','tb_receive_temporary.receive_temporary_id')
        ->where('user_id', '=' , $user_id )
        ->where('supplier_id', '=' , $supplier_id )
        ->get();
	}

	public static function select_by_id($id){
    return DB::table('tb_receive_temporary_detail')
        ->join('tb_product','tb_receive_temporary_detail.product_id','=','tb_product.product_id')
        ->where('receive_temporary_detail_id', '=' , $id )
        ->get();
	}

  public static function insert($input){
    DB::table('tb_receive_temporary_detail')->insert($input);
	}

	public static function update_by_id($input, $id){
    DB::table('tb_receive_temporary_detail')
        ->where('receive_temporary_detail_id', $id)
        ->update($input);
	}

  public static function update_key_by_id($key, $input, $id){
    DB::table('tb_receive_temporary_detail')
        ->where('receive_temporary_detail_id', $id)
        ->update($input);
	}

	public static function delete_by_id($id){
		DB::table('tb_receive_temporary_detail')
            ->where('receive_temporary_detail_id', '=', $id)
            ->delete();
	}

  public static function delete_by_receive_temporary_id($receive_temporary_id){
		DB::table('tb_receive_temporary_detail')
        ->where('receive_temporary_id', '=', $receive_temporary_id)
        ->delete();
	}
}
