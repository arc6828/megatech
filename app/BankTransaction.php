<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank_transactions';

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
    protected $fillable = ['code','bank_account_id','transaction_code', 'amount', 'balance', 'remark', 'user_id','cheque_code','document_code'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function bank_account(){        
        return $this->belongsTo('App\BankAccount','bank_account_id');
    }
}
