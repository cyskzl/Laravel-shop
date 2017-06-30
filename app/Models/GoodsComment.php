<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsComment extends Model
{
    //

    protected $table = 'goods_comment';

    public function reply()
    {
        return $this->hasMany('App\Models\GoodsCommentReply', 'comment_id');
    }
}
