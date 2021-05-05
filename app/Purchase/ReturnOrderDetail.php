<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReturnOrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'return_order_details';

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
    protected $fillable = ['product_id', 'amount', 'discount_price', 'total', 'return_order_id'];

    public function product()
    {
        return $this->belongsTo('App\ProductModel', 'product_id');
    }

    public function return_order()
    {
        return $this->belongsTo('App\Purchase\ReturnOrder', 'return_order_id', 'id');
    }
    public static function select_by_product($id)
    {
        return DB::table('return_order_details')
            ->join('tb_product', 'return_order_details.product_id', '=', 'tb_product.product_id')
            // ->where('return_order_details.id', '=' , $id )
            ->get();
    }
    
}
