<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoRebateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 货品折扣表
        Schema::create('cargo_rebate', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->string('rebate_id')->comment('折扣ID | 值为商品ID或分类ID');
            $table->integer('rebate_type')->comment('类型 货品0，分类1');
            $table->decimal('rebate_range',2,2)->comment('折扣率');
            $table->timestamp('start_time')->comment('活动开始时间');
            $table->integer('time_length')->comment('活动时长');
            $table->timestamp('end_time')->comment('活动结束时间');
            $table->tinyInteger('is_over')->comment('结束标识：0未结束 1已结束');
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
        Schema::drop('cargo_rebate');
    }
}
