<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPaymentDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'supplier_payment_details';

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
    protected $fillable = ['doc_id', 'supplier_payment_id','code','total_debt','total_payment','total_remain'];

    
}
