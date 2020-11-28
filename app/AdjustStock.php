<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjustStock extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adjust_stocks';

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
    protected $fillable = ['code', 'reference', 'adjust_type', 'status_id', 'user_id', 'adjust_definition_id', 'remark', 'total', 'revision'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
