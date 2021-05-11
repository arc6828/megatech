<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numberun extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'numberuns';

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
    protected $fillable = ['name_doc', 'datetime_doc', 'number_doc', 'number_en'];

}
