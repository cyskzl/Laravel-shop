<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用户表注册表
        Schema::create('users_register', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->string('tel')->default(1)->index()->comment('会员手机号码');
            $table->string('email')->unique()->comment('会员邮箱地址');
            $table->string('password')->comment('会员密码');
            $table->string('third_party_id')->nullable()->comment('第三方 ID');
            $table->string('status')->default(0)->comment('用户状态|0未激活 1激活');
            $table->string('register_ip')->comment('注册ip');
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
        Schema::drop('users_register');
    }
}
