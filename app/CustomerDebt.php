<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDebt extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_debts';

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
    protected $fillable = ['doc_no', 'date', 'customer_id', 'discount', 'amount', 'vat_percent', 'vat', 'total_before_vat', 'total', 'tax_type_id', 'completed_at', 'tax_category', 'round', 'type_debt', 'debt_duration', 'user_id', 'role', 'reference', 'zone_id', 'cheque_id', 'payment_method'];

    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
}
