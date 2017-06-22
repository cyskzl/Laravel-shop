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
        Schema::create('goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cate_id')->references('id')->on('goods_category')->comment('分类的ID');
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
