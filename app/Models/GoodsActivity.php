<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsActivity extends Model
{
    protected $table = 'rel_goods_activities';


    public function goods()
    {
        return $this->hasMany('App\Models\Good','goods_id','goods_id');
    }
}
