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
            $table->string('name')->comment('快递名称');
            $table->decimal('price',10,2)->defaule(0.00)->comment('邮费');
            $table->string('desc')->defalut("")->comment('描述');
            $table->tinyInteger('enabled')->default(1)->comment('开关');
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
