<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';

    /**
     * 获取与goods_id对应的goodsImages图片表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 一对多
     */
    public  function goodImages()
    {
        return $this->hasMany('App\Models\GoodsImages', 'goods_id', 'goods_id');
    }

    /**
     * 获取与goods_id对应的goodsAttr属性表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany一对多
     */
    public  function goodAttr()
    {
        return $this->hasMany('App\Models\GoodsAttr', 'goods_id', 'goods_id');
    }
    /**
     * 获取与goods_id对应的spec_goods_price属性表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany一对多
     */
    public  function specGoodsPrice()
    {
        return $this->hasMany('App\Models\SpecGoodsPrice', 'goods_id', 'goods_id');
    }

    /**
     *
     *  多对多 tags 与goods建立
     */
    public function tags()
    {
        //第一个参数是要遍历出来的模型，第二个是中间表，第三个是本类的id，第三个是关联的id
        return $this->belongsToMany('App\Models\GoodsTag', 'tags_middle_goods', 'goods_id','tags_id');
    }
}
