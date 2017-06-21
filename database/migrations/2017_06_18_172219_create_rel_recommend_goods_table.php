<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelRecommendGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_recommend_goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('recommend_id')->references('id')->on('goods_recommend')->comment('推荐位ID');
            $table->integer('cargo_id')->references('id')->on('goods_cargo')->comment('货品的ID');
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
        Schema::drop('rel_recommend_goods');
    }
}
