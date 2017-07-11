<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    //

    protected $table = 'orders_details';

    public function ordergood()
    {
        return $this->belongsTo('App\Models\Goods','goods_id','goods_id');

    }

    public function belongsToOrder()
    {
        return $this->belongsTo('App\Models\Orders','order_id','id');

    }

}


