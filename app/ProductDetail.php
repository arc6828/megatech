<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_details';

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
    protected $fillable = ['final_product_id', 'detail_product_id', 'amount', 'remark'];

    public function final_product(){
        return $this->belongsTo('App\ProductModel','final_product_id','product_id');
    }
    public function detail_product(){
        return $this->belongsTo('App\ProductModel','detail_product_id','product_id');
    }
}
