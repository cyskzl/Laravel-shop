<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('brand', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('name', 60)->nullable()->comment('品牌名称');
			$table->string('logo', 80)->nullable()->comment('品牌logo');
           $table->tinyInteger('top_cate_id')->comment('顶级分类id');
			$table->text('desc')->comment('品牌描述');
			$table->string('url')->comment('品牌地址');
			$table->tinyInteger('sort')->default(50)->unsigned()->comment(50);
			$table->tinyInteger('is_hot')->unsigned()->comment('是否推荐,0否1是');
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
        Schema::drop('brand');
    }
}
