<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveFinal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'receive_finals';

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
    protected $fillable = ['code', 'is_code', 'status_id', 'user_id', 'remark', 'total', 'revision'];

    
}
