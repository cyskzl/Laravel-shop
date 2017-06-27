<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('delivery_doc',function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('发货单ID');
            $table->unsignedInteger('order_id')->index()->unsigned()->comment('订单id');
            $table->string('order_sn')->index()->comment('订单编号');
            $table->unsignedInteger('user_id')->index()->unsigned()->comment('用户id');
            $table->unsignedInteger('admin_id')->index()->unsigned()->comment('管理员id');
            $table->string('consignee')->index()->comment('收货人');
            $table->mediumInteger('zipcode')->comment('邮编');
            $table->string('mobile',20)->index()->comment('联系手机');
            $table->unsignedInteger('country')->default(0)->unsigned()->comment('国家');
            $table->unsignedInteger('province')->default(0)->unsigned()->comment('省份');
            $table->unsignedInteger('city')->default(0)->unsigned()->comment('城市');
            $table->unsignedInteger('district')->default(0)->unsigned()->comment('县区');
            $table->unsignedInteger('twon')->default(0)->nullable()->comment('乡镇');
            $table->string('address')->comment('地址');
            $table->string('shipping_code',32)->comment('物流code');
            $table->string('shipping_name',120)->comment('物流名称');
            $table->decimal('shipping_price',10,2)->defaule(0.00)->comment('运费');
            $table->string('invoice_on',256)->comment('物流单号');
            $table->string('tel',64)->nullable()->comment('座机电话');
            $table->string('note',255)->comment('管理员添加的备注信息');
            $table->dateTime('best_time')->nullable()->comment('友好收货时间');

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
        Schema::drop('delivery_doc');
    }
}
