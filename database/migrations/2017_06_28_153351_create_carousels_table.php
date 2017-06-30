<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels',function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('轮播图ID');
            $table->string('img')->comment('轮播图 大小（最小1100*460）');
            $table->tinyInteger('type_id')->comment('分类ID：0女士|1男士|2创意生活');
            $table->string('link')->comment('跳转地址');
            $table->string('desc')->comment('描述');
            $table->tinyInteger('status')->default(1)->comment('显示状态: 0 显示 |1不显示 默认为1不显示');
            $table->integer('orderby')->comment('描述');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carousels');
    }
}
