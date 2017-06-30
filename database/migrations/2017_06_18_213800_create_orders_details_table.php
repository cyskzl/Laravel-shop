<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('商品订单详情ID');
            $table->unsignedInteger('order_id')->index()->comment('订单id');
            $table->unsignedInteger('goods_id')->index()->comment('商品id');
            $table->string('goods_sn')->index()->comment('商品货号');
            $table->smallInteger('goods_num')->unsigned()->comment('购买数量');
            $table->decimal('goods_price',10,2)->defaule(0.00)->comment('商品价格');
            $table->decimal('cost_price',10,2)->defaule(0.00)->comment('商品成本价');
            $table->decimal('member_goods_price',10,2)->defaule(0.00)->comment('会员折扣价');
            $table->mediumInteger('give_integral')->defaule(0)->comment('购买商品赠送积分');
            $table->string('spec_key',128)->defaule(" ")->comment('商品规格key');
            $table->string('spec_key_name',128)->defaule(" ")->comment('规格对应的中文名字');
            $table->tinyInteger('is_comment')->default(0)->comment('是否评价');
            $table->tinyInteger('prom_type')->default(0)->comment('0.普通订单 1.限时抢购 2.团购 3.促销优惠 4.预售');
            $table->unsignedInteger('prom_id')->index()->comment('活动id');
            $table->tinyInteger('is_send')->default(0)->comment('0.未发货 1.已发货 2.已换货 3.已退货');
            $table->unsignedInteger('delivery_id')->index()->comment('发货单id');
            $table->string('sku',128)->defaule("")->comment('sku');

            $table->timestamps();
            $table->softDeletes()->comment('删除时间');


//            $table->foreign('order_guid')->references('guid')->on('orders')->comment('订单表id键');
//            $table->foreign('user_id')->references('id')->on('users_register')->comment('用户表id外键');
//            $table->foreign('goods_id')->references('id')->on('goods')->comment('商品表id外键');
//            $table->foreign('cargo_id')->references('id')->on('goods_cargo')->comment('货品表id外键');

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
        Schema::drop('orders_details');
    }
}
