<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank_accounts';

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
    protected $fillable = ['code', 'name', 'branch', 'category_id', 'account_no', 'balance_bring_forword', 'balance'];

    
}
