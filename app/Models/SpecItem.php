<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecItem extends Model
{
   protected  $table = 'spec_item';

    /**
     * 获取spec表内容
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function spec()
    {
        return $this->belongsTo('App\Models\Spec','id','spec_id');
    }

}
