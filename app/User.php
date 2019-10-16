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
    public function Quotation(){
        return $this->hasMany('App\Sales\QuotationModel','user_id');
    }
    public function Order(){
        return $this->hasMany('App\Sales\OrderModel','user_id');
    }
    public function Invoice(){
        return $this->hasMany('App\Sales\InvoiceModel','user_id');
    }
   
   

    
    
}
