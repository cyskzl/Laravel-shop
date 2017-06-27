<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('goods_comment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('商品评论ID');
            $table->unsignedInteger('goods_id')->comment('商品ID,goods表的主键');
            $table->unsignedInteger('order_id')->index()->comment('订单编号|订单表GUID');
            $table->unsignedInteger('cargo_id')->index()->comment('商品ID,cargo表的主键');
            $table->unsignedInteger('user_id')->index()->comment('用户ID,user表的主键');
            $table->string('ip_address',4)->comment('IP地址');
            $table->string('img',255)->nullable()->comment('晒单图片');
            $table->tinyInteger('comment_type')->default(0)->comment('匿名评价  0:匿名评价 1:显示用户名| 默认为0');
            $table->tinyInteger('star')->comment('1 好评 2 中评 3 差评');
            $table->string('comment_info',255)->comment('评价内容');
            $table->tinyInteger('is_show')->default(0)->comment('是否显示评论 0显示，1不显示');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');

//            $table->foreign('goods_id')->references('id')->on('goods')->comment('商品表id外键');
//            $table->foreign('order_id')->references('id')->on('orders_details')->comment('订单详情表id键');
//            $table->foreign('cargo_id')->references('id')->on('goods_cargo')->comment('货品表id外键');
//            $table->foreign('user_id')->references('id')->on('users_register')->comment('用户表id外键');
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
        Schema::drop('goods_comment');
    }
}
