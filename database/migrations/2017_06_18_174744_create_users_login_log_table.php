<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLoginLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用户登录日志表
        Schema::create('users_login_log', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('user_id')->comment('用户注册表ID');
            $table->string('login_name')->comment('登录账号');
            $table->tinyInteger('third_party')->comment('第三方登陆: 1 网站 2 微信 3 微博 4 QQ');
            $table->string('login_ip')->comment('登录IP');
            $table->timestamp('login_time')->comment('登录时间');
            $table->softDeletes()->comment('删除时间');
            $table->timestamps();


//            $table->foreign('user_id')->references('id')->on('users_register')->comment('user_register用户表id外键');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_login_log');
    }
}
