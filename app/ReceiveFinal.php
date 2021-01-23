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

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function details(){
        return $this->hasMany('App\ReceiveFinalDetail','receive_final_id','id');
    }

    // public function is(){
    //     return $this->belongsTo('App\IssueStock','is_code','code');
    // }    

    public function issue_stock(){
        return $this->belongsTo('App\IssueStock','is_code','code');
    }


}
