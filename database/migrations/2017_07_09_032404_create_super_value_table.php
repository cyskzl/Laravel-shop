<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_value', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('满减活动名称');
            $table->string('desc')->comment('活动描述');
            $table->decimal('condition')->comment('满足条件');
            $table->decimal('preferential')->comment('优惠金额');
            $table->string('img')->comment('活动分类导图');
            $table->integer('goods_id')->comment('商品id');
            $table->string('goods_name')->comment('商品名称');
            $table->timestamp('start_time')->comment('活动开始时间');
            $table->timestamp('end_time')->comment('活动结束时间');
            $table->tinyInteger('is_over')->default(0)->comment('结束标识：0未开始，1已开始 1已结束');
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
        Schema::drop('super_value');
    }
}
