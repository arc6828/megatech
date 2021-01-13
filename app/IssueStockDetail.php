<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueStockDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'issue_stock_details';

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
    protected $fillable = ['product_id', 'amount', 'discount_price', 'total', 'issue_stock_id'];

    public function product(){
        return $this->belongsTo('App\ProductModel','product_id');
    }
}
