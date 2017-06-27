<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('订单ID');
            $table->string('sn')->index()->comment('订单编号');
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->tinyInteger('order_status')->default(0)->unsigned()->comment('订单状态-3作废订单-2无效订单-1已取消0带确认1已确认2已收货3完成');
            $table->tinyInteger('shipping_status')->default(0)->unsigned()->comment('发货状态0未发货1已发货2部分发货');
            $table->tinyInteger('pay_status')->default(0)->unsigned()->comment('支付状态0未支付1已支付');
            $table->string('consignee')->comment('收货人');
            $table->unsignedInteger('country')->default(0)->unsigned()->comment('国家');
            $table->unsignedInteger('province')->default(0)->unsigned()->comment('省份');
            $table->unsignedInteger('city')->default(0)->unsigned()->comment('城市');
            $table->unsignedInteger('district')->default(0)->unsigned()->comment('县区');
            $table->unsignedInteger('twon')->default(0)->nullable()->comment('乡镇');
            $table->string('address')->comment('地址');
            $table->string('zipcode',60)->comment('邮政编码');
            $table->string('mobile',60)->comment('手机');
            $table->string('email',60)->comment('邮件');
            $table->string('shipping_code',32)->comment('物流code');
            $table->string('shipping_name',120)->comment('物流名称');
            $table->string('pay_code',32)->comment('支付code');
            $table->string('pay_name',32)->comment('支付方式名称');
            $table->string('invoice_title',256)->comment('发票抬头');
            $table->decimal('goods_price',10,2)->defaule(0.00)->comment('商品总价');
            $table->decimal('shipping_price',10,2)->defaule(0.00)->comment('邮费');
            $table->decimal('user_money',10,2)->defaule(0.00)->comment('使用余额');
            $table->decimal('coupon_price',10,2)->defaule(0.00)->comment('优惠券抵扣');
            $table->integer('integral')->defaule(0)->unsigned()->comment('使用积分');
            $table->decimal('integral_money',10,2)->defaule(0.00)->comment('使用积分抵多少钱');
            $table->decimal('order_amount',10,2)->defaule(0.00)->comment('应付款金额');
            $table->decimal('titak_amount',10,2)->defaule(0.00)->comment('订单总价');
            $table->dateTime('shipping_time')->nullable()->comment('最后发货时间');
            $table->dateTime('confirm_time')->nullable()->comment('收货确认时间');
            $table->dateTime('pay_time')->nullable()->comment('支付时间');
            $table->tinyInteger('prder_prom_type')->defaule(0)->comment('0默认1抢购2团购3优惠4预售');
            $table->unsignedInteger('prder_prom_id')->defaule(0)->comment('活动id');
            $table->decimal('prder_prom_amount',10,2)->defaule(0.00)->comment('活动优惠金额');
            $table->decimal('discount',10,2)->defaule(0.00)->comment('价格调整');
            $table->string('user_note',255)->comment('用户备注');
            $table->string('admin_note',255)->comment('管理员备注');
            $table->string('parent_sn')->index()->comment('父单单号');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');


//            $table->foreign('user_id')->references('id')->on('users_register');
            
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
        Schema::drop('orders');
    }
}
