<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'supplier_payments';

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
    protected $fillable = ['doc_no', 'supplier_id', 'role', 'remark', 'round', 'supplier_billing_id', 'discount', 'debt_total', 'cash', 'credit', 'tax', 'payment_total', 'user_id'];

    public function supplier(){
        return $this->belongsTo('App\SupplierModel','supplier_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function supplier_billing(){
        return $this->belongsTo('App\SupplierBilling','supplier_billing_id');
    }

    public function supplier_receives(){
        return $this->hasMany('App\Purchase\ReceiveModel','supplier_payment_id');
    }
}
