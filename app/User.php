<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function customer(){
        return $this->hasMany('App\CustomerModel','user_id');
    }
    public function Quotation(){
        return $this->hasMany('App\Sales\QuotationModel','user_id');
    }
    public function Order(){
        return $this->hasMany('App\Sales\OrderModel','user_id');
    }
    public function Invoice(){
        return $this->hasMany('App\Sales\InvoiceModel','user_id');
    }
    
    //Purchase
    public function Requisition()
    {
        return $this->hasMany('App\Purchase\RequisitionModel','user_id');
    }
    public function PurchaseOrder()
    {
        return $this->hasMany('App\Purchase\OrderModel','user_id');
    }
    public function Receive()
    {
        return $this->hasMany('App\Purchase\ReceiveModel','user_id');
    }
   
   

    
    
}
