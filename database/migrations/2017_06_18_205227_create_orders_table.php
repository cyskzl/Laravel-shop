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
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->char('guid', 32)->index()->comment('订单编号');
            $table->json('cargo_message')->comment('下单商品信息 :单价、数量、商品ID');
            $table->string('name_message',52)->comment('收货人姓名');
            $table->json('address_message')->comment('收货地址信息');
            $table->string('pay_transaction', 64)->comment('支付交易号');
            $table->tinyInteger('pay_type')->comment('支付方式 1:支付宝 2:微信 3:其他');
            $table->tinyInteger('pay_status')->index()->comment('支付状态 1:待支付 2:已支付 3:取消支付');
            $table->tinyInteger('order_status')->index()->comment('订单状态 1:待付款 2: 待发货 3:待收货 4 完成 5取消  默认为1');
            $table->decimal('total_amount', 19, 2)->comment('商品总金额');
            $table->timestamps();
            $table->softDeletes()->comment('删除时间');


            $table->foreign('user_id')->references('id')->on('users_register');
            
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
