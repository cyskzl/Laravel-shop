<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pay_method',function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('支付方式id');
            $table->string('pay_name')->comment('支付名称');
            $table->string('pay_desc')->defalut("")->comment('描述');
            $table->tinyInteger('enabled')->default(0)->comment('开关');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('pay_method');
    }
}
