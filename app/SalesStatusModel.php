<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalesStatusModel extends Model
{
  protected $table = "tb_sales_status";
  protected $primaryKey = 'sales_status_id';
  protected $fillable = [];

  public static function select_all()
  {
    return DB::table('tb_sales_status')->get();
  }
  public static function select_by_category($category)
  {
    return DB::table('tb_sales_status')
      ->where('category', $category)
      ->get();
  }
  public function invoice()
  {
    return $this->hasMany('App\Sales\InvoiceModel', 'sales_status_id');
  }
  public function order()
  {
    return $this->hasMany('App\Sales\OrderModel', 'sales_status_id');
  }
  public function quotation()
  {
    return $this->hasMany('App\Sales\QuotationModel', 'sales_status_id');
  }
}
