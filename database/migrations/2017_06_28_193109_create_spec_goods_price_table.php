<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecGoodsPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_goods_price', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('goods_id')->unsigned()->default(0)->comment('商品的ID');
            $table->string('key')->default('')->comment('规格键名');
            $table->decimal('price', 10, 2)->default(0)->unsigned()->comment('价格');
            $table->integer('store_count')->unsigned()->default(10)->unsigned()->comment('库存数量');
            $table->string('bar_code')->default('')->comment('商品条形码');
            $table->string('sku')->default('')->comment('SKU');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('spec_goods_price');
    }
}
