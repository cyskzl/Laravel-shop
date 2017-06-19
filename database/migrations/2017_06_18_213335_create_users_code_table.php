<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 会员积分表
        Schema::create('users_code', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->integer('code')->comment('会员总积分');
            $table->integer('cost_num')->comment('消耗积分总和');
            $table->tinyInteger('status')->comment('积分状态');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users_register')->comment('user_register用户表id外键');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_code');
    }
}
