<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'order';

    public function ordersDetails()
    {
        return $this->hasMany('App\Models\OrdersDetails','order_guid','guid');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\UserRegister','user_id');
    }

    public function ordergood()
    {
        return $this->hasMany('App\Models\OrderGood','order_id','id');
    }

}
