<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsRecommendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_recommend', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('recommend_name')->comment('推荐位名称');
            $table->tinyInteger('recommend_location')->comment('推荐位位置 1 首页 ');
            $table->tinyInteger('recommend_type')->comment('推荐位类型');
            $table->string('recommend_introduction')->comment('楼位导语');
            $table->softDeletes();//删除时间
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_recommend');
    }
}
