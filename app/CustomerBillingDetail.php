<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerBillingDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_billing_details';

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
    protected $fillable = ['doc_id', 'customer_billing_id'];

    public function customer_billing(){
        return $this->belongsTo('App\CustomerBilling','customer_billing_id');
    }

    public function invoice(){
        return $this->belongsTo('App\Sales\InvoiceModel','doc_id');
    }
    
}
