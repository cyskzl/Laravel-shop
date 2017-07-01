<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_emails', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('注册邮箱临时存储表ID');
            $table->string('user_id')->comment('用户注册表的外键');
            $table->string('uuid')->comment('发送给用户邮件里的uuid');
            $table->timestamp('deadline')->comment('过期时间');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');

//            $table->foreign('user_id')->references('id')->on('users_register')->comment('用户注册表id外键');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('temp_emails');
    }
}
