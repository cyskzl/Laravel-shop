<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendpromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trendpromotion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 60)->nullable()->comment('标题名称');
            $table->string('img', 80)->nullable()->comment('主图');
            $table->tinyInteger('top_cate_id')->comment('顶级分类id');
            $table->text('desc')->comment('描述');
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
        Schema::drop('trendpromotion');
    }
}
