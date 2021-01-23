<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calendars';

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
    protected $fillable = ['title', 'first_billing_date', 'customer_id', 'supplier_id'];

    public function calendar_dates(){
        return $this->hasMany('App\CalendarDate','calendar_id');
    }
}
