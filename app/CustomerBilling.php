<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerBilling extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_billings';

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
    protected $fillable = ['doc_no', 'total', 'customer_id', 'condition_billing', 'condition_cheque', 'date_billing', 'date_cheque', 'remark', 'user_id'];

    
}
