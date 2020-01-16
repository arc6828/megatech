<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullCalendar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'full_calendars';

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
    protected $fillable = ['title', 'start', 'end', 'name', 'customer_id', 'supplier_id'];

    
}
