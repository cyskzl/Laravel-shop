<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersOperationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 前台用户操作日志表
        Schema::create('users_operation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->integer('operator_id')->references('id')->on('users_register')->index()->comment('用户ID');
            $table->integer('login_ip')->comment('操作IP');
            $table->text('content')->comment('操作内容');
            $table->text('events')->comment('操作事件');
            $table->softDeletes()->comment('删除时间');
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
        Schema::drop('users_operation');
    }
}
