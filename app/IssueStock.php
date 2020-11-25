<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueStock extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'issue_stocks';

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
    protected $fillable = ['code', 'product_id', 'amount', 'status_id', 'user_id', 'remark', 'total', 'revision'];

    
}
