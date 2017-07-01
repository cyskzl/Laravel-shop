<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用户详细信息表
        Schema::create('users_info', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('user_id')->comment('用户注册表ID');
            $table->string('nickname')->nullable()->comment('用户昵称');
            $table->string('realname')->nullable()->comment('真实姓名');
            $table->string('email')->comment('用户邮箱');
            $table->string('tel')->default('')->comment('用户手机号码');
            $table->tinyInteger('sex')->nullable()->comment('性别：1男2女');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('id_number')->nullable()->comment('身份证号');
            $table->string('answer_1')->nullable()->comment('密保问题1');
            $table->string('answer_2')->nullable()->comment('密保问题2');
            $table->string('birthday')->nullable()->comment('生日');
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
        Schema::drop('users_info');
    }
}
