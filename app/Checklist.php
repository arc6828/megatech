<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checklists';

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
    protected $fillable = ['billing_invoice', 'billing_po', 'billing_receipt', 'billing_envelope', 'billing_delivery', 'billing_reference', 'cheque_billing', 'cheque_receipt', 'cheque_po', 'type', 'customer_id', 'supplier_id'];

    
}
