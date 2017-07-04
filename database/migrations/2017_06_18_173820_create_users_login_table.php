<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用户表登录索引表
        Schema::create('users_login', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->string('login_name')->comment('登录账号');
            $table->string('password')->comment('登录密码');
            $table->string('last_login_ip')->comment('最后一次登录IP');
            $table->string('remember_token')->default('')->comment('token');
            $table->timestamp('last_login_at')->comment('最后一次登录时间');
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
        Schema::drop('users_login');
    }
}
