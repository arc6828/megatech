<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cheques';

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
    protected $fillable = ['cheque_type_code','doc_no', 'cheque_date', 'cheque_type', 'cheque_no', 'total', 'bank_fee', 'bank_account_id', 'passed_cheque_date', 'reference', 'status', 'user_id'];

    public function bank_account(){
        return $this->belongsTo('App\BankAccount','bank_account_id');
    }
}
