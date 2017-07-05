<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = 'goods_category';

    /**
     *
     *  多对多 tags 与cate建立
     */
    public function tags()
    {
        //第一个参数是要遍历出来的模型，第二个是中间表，第三个是本类的id，第三个是关联的id
        return $this->belongsToMany('App\Models\GoodsTag', 'cate_middle_goods', 'cate_id','tags_id');
    }

}
