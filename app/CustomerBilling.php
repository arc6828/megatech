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
    protected $fillable = ['doc_no', 'total', 'customer_id', 'condition_billing', 'condition_cheque', 'date_billing', 'date_cheque', 'remark', 'user_id','status'];

    public function customer(){
        return $this->belongsTo('App\CustomerModel','customer_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function customer_billing_details(){
        return $this->hasMany('App\CustomerBillingDetail','customer_billing_id');
    }

    public function customer_payment(){ 
        //NOT SURE hasOne or hasMany
        return $this->hasOne('App\CustomerPayment','customer_billing_id');
    }

}
