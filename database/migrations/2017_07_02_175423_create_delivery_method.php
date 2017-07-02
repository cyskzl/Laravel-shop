<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('delivery_method',function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('发货方式id');
            $table->string('pay_name')->comment('发货名称');
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
        Schema::drop('delivery_method');
    }
}
