<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_payments';

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
    protected $fillable = ['doc_no', 'customer_id', 'role', 'remark', 'round', 'customer_billing_id', 'discount', 'debt_total', 'cash', 'credit', 'tax', 'payment_total', 'user_id'];

    public function customer(){
        return $this->belongsTo('App\CustomerModel','customer_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function customer_billing(){
        return $this->belongsTo('App\CustomerBilling','customer_billing_id');
    }
}
