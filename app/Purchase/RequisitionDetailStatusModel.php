<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisitionDetailStatusModel extends Model
{
    protected $table = "tb_purchase_requisition_detail_status";
    protected $primaryKey = 'purchase_requisition_detail_status_id';
    protected $fillable = [];
    
    public static function select_all(){
      return DB::table('tb_purchase_requisition_detail_status')
            ->get();
    }
}
