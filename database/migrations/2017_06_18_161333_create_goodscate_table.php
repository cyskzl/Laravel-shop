<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodscateTable extends Migration
{
    /**
     * 分类表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pid')->default(0)->comment('分类的父ID');
            $table->tinyInteger('level')->default(0)->comment('分类层级');
            $table->string('name')->comment('分类名');
            $table->string('img', 64)->nullable()->comment('图标或图片');
            $table->string('describe')->nullable()->comment('分类用的描述');
            $table->softDeletes();//删除时间
            $table->timestamps();

        });
    }

    /**
     * 分类表回滚
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_category');
    }
}
