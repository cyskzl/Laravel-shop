<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCodeMonthLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 会员积分月度记录表
        Schema::create('users_code_month_log', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->integer('get_code')->comment('当月获得积分');
            $table->integer('leave_code')->comment('当月剩余积分');
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
        Schema::drop('users_code_month_log');
    }
}
