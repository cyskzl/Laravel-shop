<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('goods_id')->references('id')->on('goods')->comment('商品ID');
            $table->integer('cargo_id')->references('id')->on('goods_cargo')->comment('货品的ID');
            $table->text('body')->comment('全文本索引 | 分词后的内容 ');
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
        Schema::drop('index_goods');
    }
}
