<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * 商品表
     *
     * @return void
     */
    public function up()
    {
//        `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
//  `cat_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
//  `extend_cat_id` int(11) DEFAULT '0' COMMENT '扩展分类id',
//  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品编号',
//  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
//  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
//  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
//  `store_count` smallint(5) unsigned NOT NULL DEFAULT '10' COMMENT '库存数量',
        Schema::create('goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('goods_id');
            $table->integer('cat_id')->references('id')->on('goods_category')->comment('分类的ID');
            $table->string('goods_name',120);
            $table->integer('click_count',10)->unsigned()->default(0);
            $table->integer('brand_id')->unsigned()->default(0);
            $table->tinyInteger('goods_status')->default(1)->comment('商品状态 1:待售 2:上架 3:下架 | 默认为 1');
            $table->string('goods_title')->comment('商品标题');
            $table->string('goods_original')->comment('商品原图 | 多图');
            $table->text('goods_info')->comment('图文详细信息');
            $table->softDeletes();//删除时间
            $table->timestamps();

        });
    }

    /**
     * 商品表回滚
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods');
    }
}
