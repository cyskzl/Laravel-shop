<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 收货地址表
        Schema::create('receiving_address', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->string('consignee')->comment('收货人');
            $table->string('tel')->comment('收货人手机号码');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('城市');
            $table->string('country')->comment('县');
            $table->string('detailed_address')->comment('详细地址');
            $table->tinyInteger('status')->comment('地址状态|1普通 2默认');
            $table->softDeletes()->comment('删除时间');
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
        Schema::drop('receiving_address');
    }
}
