<?php

namespace App\Purchase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReturnOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'return_orders';

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
    protected $fillable = ['code', 'supplier_id', 'purchase_receive_code', 'tax_type_id', 'purchase_status_id', 'user_id', 'remark', 'total_before_vat', 'vat', 'vat_percent', 'total_after_vat', 'revision'];

    public function return_order_details()
    {
        return $this->hasMany('App\Purchase\ReturnOrderDetail', 'return_order_id', 'id');
    }

    public function details()
    {
        return $this->hasMany('App\Sales\ReturnInvoiceDetail', 'return_invoice_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\SupplierModel', 'supplier_id', 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public static function select_all()
    {
        return DB::table('return_orders')->get();
    }
 
    public static function select_by_id($id)
    {
        return DB::table('return_orders')
            ->join('tb_supplier', 'return_orders.supplier_id', '=', 'tb_supplier.supplier_id')
            ->where('return_orders.id', '=', $id)
            ->get();
    }
}
