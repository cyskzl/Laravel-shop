<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';

    public function ordersDetails()
    {
        return $this->hasMany('App\Models\OrdersDetails','order_guid','guid');
    }

}
