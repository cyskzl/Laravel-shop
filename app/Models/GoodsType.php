<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsType extends Model
{
    protected  $table = 'goods_type';
//    public $timestamps = false;

    /**
     * 远程一对多，3表关联
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function spec_item()
    {
        return $this->hasManyThrough('App\Models\SpecItem', 'App\Models\Spec', 'type_id', 'spec_id');
    }

}
