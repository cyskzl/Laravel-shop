<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDelivery extends Model
{
    //
    protected $table = 'order_delivery';

    public function belongsToOrders()
    {
        return $this->belongsTo('App\Models\Orders','order_id','id');
    }
}
