<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPaymentDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_payment_details';

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
    protected $fillable = ['doc_id', 'customer_payment_id','code','total_debt','total_payment','total_remain'];

    public function invoice(){
        return $this->belongsTo('App\Sales\InvoiceModel','code','invoice_code');
    }
    public function customer_payment(){
      return $this->belongsTo('App\CustomerPaymentDetail','customer_payment_id');
    }


}
