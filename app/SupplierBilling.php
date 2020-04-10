<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBilling extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'supplier_billings';

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
    protected $fillable = ['doc_no', 'total', 'supplier_id', 'condition_billing', 'condition_cheque', 'date_billing', 'date_cheque', 'remark', 'user_id','status'];

    public function supplier(){
        return $this->belongsTo('App\SupplierModel','supplier_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function supplier_billing_details(){
        return $this->hasMany('App\SupplierBillingDetail','supplier_billing_id');
    }

    public function supplier_payment(){ 
        //NOT SURE hasOne or hasMany
        return $this->hasOne('App\SupplierPayment','supplier_billing_id');
    }

}
