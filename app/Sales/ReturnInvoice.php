<?php

namespace App\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    protected $fillable = ['code', 'customer_id', 'invoice_code', 'tax_type_id', 'sales_status_id', 'user_id', 'remark', 'total_before_vat', 'vat', 'vat_percent', 'total_after_vat', 'revision', 'staff_id',];

    
    public function return_invoice_details(){
        return $this->hasMany('App\Sales\ReturnInvoiceDetail','return_invoice_id','id');
    }

    public function customer(){
        return $this->belongsTo('App\CustomerModel','customer_id','customer_id');
    }

    public function tax_type(){
        return $this->belongsTo('App\TaxTypeModel','tax_type_id','tax_type_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
       
    public function staff(){
        return $this->belongsTo('App\User','staff_id');
    }
    // public static function select_all()
    // {
    //     return DB::table('return_invoices')->get();
    // }

    // public static function select_by_id($id)
    // { ยกเลิกการใช้งาน
    //     return DB::table('return_invoices')
    //       ->join('tb_customer','return_invoices.customer_id','=', 'tb_customer.customer_id')
    //       ->where('return_invoices.id', '=' , $id )
    //       ->select(DB::raw('return_invoices.*','tb_customer.*'))
    //       ->get();
    // }
}
