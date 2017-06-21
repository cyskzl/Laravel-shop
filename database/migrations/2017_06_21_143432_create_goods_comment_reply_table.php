<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCommentReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('goods_comment_reply',function (Blueprint $table){
            $table->increments('id')->comment('商品评论回复表id');
            $table->unsignedInteger('comment_id')->index()->comment('商品评论表ID');
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->unsignedInteger('admin_id')->index()->comment('管理员ID');
            $table->varvhar('reply_info',255)->comment('回复的内容');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');


            //外键
            $table->foreign('comment_id')->references('id')->on('goods_comment')->comment('评论表 id外键');
            $table->foreign('user_id')->references('id')->on('users_register')->comment('用户表id外键');
            $table->foreign('admin_id')->references('id')->on('admin_users')->comment('管理员id外键');
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
        Schema::drop('goods_comment_reply');

    }
}
