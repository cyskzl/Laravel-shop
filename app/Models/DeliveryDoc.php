<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDoc extends Model
{
    //
    protected $table = 'delivery_doc';

    public function belongsToOrders()
    {
        return $this->belongsTo('App\Models\Orders','order_id','id');
    }

    public function belongsToOrdersDetalis()
    {
        return $this->hasMany('App\Models\OrdersDetails','order_id','order_id');
    }

}
