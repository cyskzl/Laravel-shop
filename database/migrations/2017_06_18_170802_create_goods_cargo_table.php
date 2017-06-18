<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_cargo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cate_id')->references('id')->on('goods_category')->comment('分类的ID');
            $table->integer('goods_id')->references('id')->on('goods')->comment('商品的ID');
            $table->string('cargo_name')->comment('货品名称');
            $table->string('cargo_cover')->comment('货品封面');
            $table->integer('inventory')->comment('库存量');
            $table->decimal('cargo_price',7)->comment('货品原价');
            $table->decimal('cargo_discount',7)->comment('货品折扣');
            $table->integer('sales_volume')->comment('销售量');
            $table->integer('number_of_comments')->comment('评论数');
            $table->string('cargo_original')->comment('货品原图 | 多图');
            $table->string('cargo_info')->comment(' 货品详情 | 多图');
            $table->tinyInteger('cargo_status')->default(1)->comment('货品状态 1:待售 2:上架 3:下架 |默认为 1');
            $table->softDeletes();//删除时间
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
        Schema::drop('goods_cargo');
    }
}
