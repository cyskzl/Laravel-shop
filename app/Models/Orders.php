<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    //
    protected $table = 'orders';

    use SoftDeletes;

    protected $dates = ['delete_at'];

    public function users()
    {
        return $this->belongsTo('App\Models\UserRegister','user_id');
    }

    public function ordergood()
    {
        return $this->hasMany('App\Models\OrdersDetails','order_id','id');
    }

}
