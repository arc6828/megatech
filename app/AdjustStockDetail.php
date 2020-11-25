<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjustStockDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adjust_stock_details';

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
    protected $fillable = ['product_id', 'amount', 'discount_price', 'total', 'adjust_id'];

    
}
