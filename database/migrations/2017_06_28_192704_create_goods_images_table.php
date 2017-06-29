<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('img_id');
            $table->integer('goods_id')->unsigned()->default(0)->comment('商品ID');
            $table->string('image_url')->comment('图片路径');
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
        Schema::drop('goods_images');
    }
}
