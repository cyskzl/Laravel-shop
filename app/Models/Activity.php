<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // 商品活动表建立一多关系
    public function goodsActivity()
    {
        return $this->hasMany('App\Models\GoodsActivity','activity_id');
    }
}
