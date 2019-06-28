<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product2 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product2s';

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
    protected $fillable = ['product_code', 'product_name', 'product_detail', 'brand', 'promotion_price', 'floor_price', 'max_discount_percent', 'amount_in_stock', 'product_unit', 'pending_in', 'pending_out', 'normal_price', 'BARCODE', 'purchase_price', 'purchase_ref', 'ISBN', 'quantity'];

    
}
