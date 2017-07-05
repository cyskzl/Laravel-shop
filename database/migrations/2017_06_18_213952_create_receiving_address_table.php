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
            $table->integer('user_id')->comment('用户ID');
            $table->string('consignee',60)->comment('收货人');
            $table->string('email',60)->comment('邮箱地址');
            $table->integer('country')->default(0)->comment('国家|0默认为中国');
            $table->integer('province')->comment('省份');
            $table->integer('city')->comment('城市');
            $table->integer('district')->comment('地区');
            $table->integer('twon')->comment('乡镇');
            $table->string('zipcode',60)->nullable()->comment('邮政编码');
            $table->string('mobile',60)->comment('手机');
            $table->string('detailed_address',120)->comment('详细地址');
            $table->tinyInteger('is_default')->default(1)->comment('默认收货地址 0默认 1其他 ');
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
        Schema::drop('receiving_address');
    }
}
