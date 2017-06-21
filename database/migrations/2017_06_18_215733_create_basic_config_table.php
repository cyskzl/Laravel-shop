<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 网站基本信息表
        Schema::create('basic_config', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键');
            $table->string('site_name')->comment('网站名称');
            $table->string('site_describe')->comment('网站描述');
            $table->string('telephone')->comment('400电话');
            $table->string('logo')->comment('网站logo');
            $table->tinyInteger('level_set')->comment(' 分类层级设置 默认 4级');
            $table->string('record_number')->comment('网站备案号');
            $table->string('address')->comment('公司地址');
            $table->string('copyright')->comment('版权信息');
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
        Schema::drop('basic_config');
    }
}
