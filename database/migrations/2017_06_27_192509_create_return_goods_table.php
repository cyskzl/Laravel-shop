<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('return_goods',function (Blueprint $table){
           $table->engine = 'InnoDB';
            $table->increments('id')->comment('退货单ID');
            $table->unsignedInteger('order_id')->index()->unsigned()->comment('订单id');
            $table->string('order_sn')->index()->comment('订单编号');
            $table->tinyInteger('type')->default(0)->comment('0.退货 1.换货');
            $table->string('reason',1024)->comment('退换货原因');
            $table->string('imgs',512)->nullable()->comment('拍照图片路径');
            $table->tinyInteger('status')->default(0)->comment('-2用户取消-1审核不通过0待审核1通过2已发货3已完成');
            $table->string('remark',512)->nullable()->comment('客服备注');
            $table->unsignedInteger('user_id')->index()->unsigned()->comment('用户id');
            $table->string('spec_key',64)->nullable()->comment('商品规格key，对应 spec_goods_price表');
            $table->string('seller_delivery',512)->nullable()->comment('换货服务，卖家重新发货信息');
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
        Schema::drop('return_goods');
    }
}
