<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 60)->nullable()->comment('广告名称');
            $table->string('logo', 80)->nullable()->comment('广告logo');
            $table->tinyInteger('top_cate_id')->comment('顶级分类id');
            $table->text('desc')->comment('广告描述');
            $table->string('url')->comment('广告地址');
            $table->tinyInteger('sort')->default(50)->unsigned()->comment(50);
            $table->tinyInteger('is_display')->unsigned()->comment('是否显示,0否1是');
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
        Schema::drop('advertisement');
    }
}
