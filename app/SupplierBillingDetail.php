<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBillingDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'supplier_billing_details';

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
    protected $fillable = ['doc_id', 'supplier_billing_id'];

    public function supplier_billing(){
        return $this->belongsTo('App\SupplierBilling','supplier_billing_id');
    }

    public function receive(){
        return $this->belongsTo('App\Purchase\ReceiveModel','doc_id');
    }
    
}
