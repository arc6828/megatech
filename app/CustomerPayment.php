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
    protected $fillable = ['doc_no', 'customer_id', 'role', 'remark', 'round', 'customer_billing_id', 'discount', 'debt_total', 'cash', 'credit', 'tax', 'payment_total', 'user_id','payment_file'];

    public function customer(){
        return $this->belongsTo('App\CustomerModel','customer_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function customer_payment_details(){
        return $this->hasMany('App\CustomerPaymentDetail','customer_payment_id','id');
    }

    public function customer_billing(){
        return $this->belongsTo('App\CustomerBilling','customer_billing_id');
    }

    public function customer_invoices(){
        return $this->hasMany('App\Sales\InvoiceModel','customer_payment_id');
    }

    
    public function customer_debts(){
        return $this->hasMany('App\CustomerDebt','customer_payment_id');
    }

    public function bank_transactions(){
        return $this->hasMany('App\BankTransaction','document_code','doc_no');
    }
}
