<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->comment('登录的管理员名称');
            $table->integer('user_id')->comment('管理员ID');
            $table->string('content')->comment('登录时信息');
            $table->tinyInteger('status')->comment('登录时状态');
            $table->string('login_ip',100)->comment('登录时ip');
            $table->dateTime('login_time')->comment('登录时间');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_log');
    }
}
