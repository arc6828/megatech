<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisitionDetailStatusModel extends Model
{
  public static function select_all(){
    return DB::table('tb_purchase_requisition_detail_status')
          ->get();
  }
}
