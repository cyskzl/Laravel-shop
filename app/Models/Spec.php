<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    protected  $table = 'spec';
    public $timestamps = false;

    /**
     *  获取typeid的内容
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function spec()
    {
        return $this->belongsTo('App\Models\GoodsType','type_id','id');
    }

    /**
     * 获取item字段
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specitem()
    {
        return $this->belongsTo('App\Models\SpecItem','id','spec_id');
    }
}
