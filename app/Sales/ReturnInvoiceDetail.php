<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class ReturnInvoiceDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'return_invoice_details';

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
    protected $fillable = ['product_id', 'amount', 'discount_price', 'total', 'return_invoice_id'];

    public function product(){
        return $this->belongsTo('App\ProductModel','product_id');
    }

    public function return_invoice(){
        return $this->belongsTo('App\Sales\ReturnInvoice','return_invoice_id','id');
    }
}
