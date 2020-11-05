<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;

class ReturnInvoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'return_invoices';

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
    protected $fillable = ['code', 'customer_id', 'invoice_code', 'tax_type_id', 'sales_status_id', 'user_id', 'remark', 'total_before_vat', 'vat', 'vat_percent', 'total_after_vat', 'revision'];

    
    public function return_invoice_details(){
        return $this->hasMany('App\Sales\ReturnInvoiceDetail','return_invoice_id','id');
    }
       
}
