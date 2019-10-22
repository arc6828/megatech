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
    protected $fillable = ['code', 'amount', 'balance', 'remark', 'user_id'];

    
}
