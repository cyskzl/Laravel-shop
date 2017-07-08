<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 商品活动表
        Schema::create('activities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('活动名称');
            $table->string('desc')->comment('活动描述');
            $table->tinyInteger('type')->comment('活动类型 1:促销 2:折扣 3:团购 4:超值');
            $table->string('img')->comment('活动分类导图');
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
        Schema::drop('activities');
    }
}
