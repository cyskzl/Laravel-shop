<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('商品订单详情ID');
            $table->char('order_guid',32)->index()->comment('订单编号|订单表GUID');
            $table->unsignedInteger('user_id')->index()->comment('用户ID,user表的主键');
            $table->unsignedInteger('goods_id')->index()->comment('商品ID,goods表的主键');
            $table->unsignedInteger('cargo_id')->index()->comment('商品ID,cargo表的主键');;
            $table->tinyInteger('order_status')->default(1)->comment('订单状态 1:待付款 2:待发货 3:待收货 4:待评价 5 完成 6 取消  默认为1');
            $table->integer('commodity_number')->index()->comment('商品数量');
            $table->decimal('cargo_price', 19, 2)->comment('商品单价');
            $table->tinyInteger('return_status')->default(1)->comment('退货状态 1 不退货 2:退货 默认为1 ');
            $table->tinyInteger('comment_status')->default(1)->comment('评论状态: 1 未评论 2:已评论 默认为1 ');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');


            $table->foreign('order_guid')->references('id')->on('orders')->comment('订单表id键');
            $table->foreign('user_id')->references('id')->on('users_register')->comment('用户表id外键');
            $table->foreign('goods_id')->references('id')->on('goods')->comment('商品表id外键');
            $table->foreign('cargo_id')->references('id')->on('goods_cargo')->comment('货品表id外键');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('orders_details');
    }
}
