<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupBuyingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_buying', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('团购名称');
            $table->string('desc')->comment('团购描述');
            $table->string('img')->comment('活动分类导图');
            $table->integer('act_num')->comment('参团数量');
            $table->decimal('act_price')->comment('参团价格');
            $table->integer('buy_num')->comment('已参团购买数量');
            $table->string('goods_id')->comment('商品id');
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
        Schema::drop('group_buying');
    }
}
