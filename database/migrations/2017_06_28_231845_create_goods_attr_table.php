<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attr', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('goods_attr_id');
            $table->integer('goods_id')->unsigned()->default(0)->comment('商品ID');
            $table->smallInteger('attr_id')->unsigned()->nullable()->default(0)->comment('属性id');
            $table->text('attr_value')->nullable()->comment('属性值');
            $table->string('attr_price')->default(0)->comment('属性价格');
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
        Schema::drop('goods_attr');
    }
}
