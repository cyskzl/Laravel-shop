<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersReturn extends Model
{
    //
    protected $table = 'return_goods';

    public function belongsToOrders()
    {
        return $this->belongsTo('App\Models\Orders');
    }
}
