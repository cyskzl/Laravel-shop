<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateMiddleGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate_middle_goods', function (Blueprint $table) {
            $table->string('cate_id')->comment('分类id');
            $table->integer('tags_id')->comment('标签id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cate_middle_goods');
    }
}
