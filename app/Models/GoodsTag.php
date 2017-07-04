<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsTag extends Model
{
    protected $table    = 'goods_tag';

    protected $fillable = [
        'tag_name'
    ];


}
