<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('goods_id');
            $table->integer('cat_id')->nullable()->default(0)->comment('分类ID');
            $table->string('goods_sn')->default('')->comment('商品编号');
            $table->string('goods_name')->nullable()->default('')->comment('商品名称');
            $table->integer('click_count')->unsigned()->default(0)->comment('点击数');
            $table->smallInteger('brand_id')->unsigned()->default(0)->comment('品牌id');
            $table->smallInteger('store_count')->unsigned()->default(10)->comment('库存数量');
            $table->smallInteger('comment_count')->default(0)->comment('商品评论数');
            $table->integer('weight')->unsigned()->default(0)->comment('商品重量克为单位');
            $table->decimal('market_price', 10, 2)->default('0.00')->comment('市场价');
            $table->decimal('shop_price', 10, 2)->default('0.00')->comment('本店价');
            $table->decimal('cost_price', 10, 2)->default('0.00')->comment('商品成本价');
            $table->text('price_ladder')->comment('价格阶梯');
            $table->string('keywords')->default('')->comment('商品关键词');
            $table->string('goods_remark')->default('')->comment('商品简单描述');
            $table->text('goods_content')->comment('商品详细描述');
            $table->string('original_img')->comment('商品上传原始图');
            $table->tinyInteger('is_real')->unsigned()->default(1)->nullable()->commetn('是否为实物,1是0否');
            $table->tinyInteger('is_on_sale')->unsigned()->default(1)->nullable()->commetn('是否上架,1是0否');
            $table->tinyInteger('is_free_shipping')->unsigned()->default(0)->nullable()->commetn('是否包邮,1是0否');
            $table->tinyInteger('on_time')->unsigned()->default(0)->nullable()->commetn('商品上架时间');
            $table->smallInteger('sort')->unsigned()->default(50)->comment('商品排序');
            $table->tinyInteger('is_recommend')->unsigned()->default(0)->nullable()->commetn('是否推荐,1是0否');
            $table->tinyInteger('is_new')->unsigned()->default(0)->nullable()->commetn('是否新品,1是0否');
            $table->tinyInteger('is_hot')->unsigned()->default(0)->nullable()->commetn('是否热卖,1是0否');
            $table->smallInteger('goods_type')->unsigned()->default(0)->comment('商品所属类型id，取值表goods_type的cat_id');
            $table->smallInteger('spec_type')->unsigned()->default(0)->comment('商品规格类型，取值表goods_type的cat_id');
            $table->integer('sales_sum')->default(0)->comment('商品销量');
            $table->tinyInteger('prom_type')->default(0)->comment('0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠,4预售');
            $table->integer('prom_id')->default(0)->comment('优惠活动id');
            $table->string('shipping_area_ids')->default('')->comment('配送物流shipping_area_id,以逗号分隔');
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
        Schema::drop('goods');
    }
}
