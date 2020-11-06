<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;

class ReturnOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'return_orders';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'supplier_id', 'purchase_receive_code', 'tax_type_id', 'purchase_status_id', 'user_id', 'remark', 'total_before_vat', 'vat', 'vat_percent', 'total_after_vat', 'revision'];

    public function return_order_details(){
        return $this->hasMany('App\Purchase\ReturnOrderDetail','return_order_id','id');
    }
}
