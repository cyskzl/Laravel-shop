<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('spec', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
			 $table->integer('type_id')->unsigned()->nullable()->default(0)->comment('规格类型');
			 $table->string('name')->nullable()->comment('规格名称');
			 $table->tinyInteger('order')->unsigned()->nullable()->default(50)->comment('排序');
			$table->tinyInteger('search_index',1)->unsigned()->default(0)->comment('0不需要检索 1检索 ');
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
        Schema::drop('spec');
    }
}
