<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('goods_attribute', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('attr_id');
			$table->string('attr_name', 60)->nullable()->comment('品牌名称');
			 $table->integer('type_id')->unsigned()->nullable()->default(0)->comment('属性分类id');
			$table->tinyInteger('attr_index',1)->unsigned()->default(0)->comment('0不需要检索 1关键字检索 2范围检索');
			$table->tinyInteger('attr_type',1)->unsigned()->default(0)->comment('0唯一属性 1单选属性 2复选属性');
			$table->tinyInteger('attr_input_type', 1)->unsigned()->default(0)->comment('0 手工录入 1从列表中选择 2多行文本框');
			$table->text('attr_values')->comment('可选值列表');
			$table->tinyInteger('order')->unsigned()->nullable()->default(50)->comment('属性排序');
			
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
        Schema::drop('goods_attribute');
    }
}
