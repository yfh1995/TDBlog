<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 网站配置信息
 */
class CreateBaseConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->comment('模型id');
            $table->string('key')->unique()->comment('配置键');
            $table->string('value')->comment('配置值');
            $table->tinyInteger('status')->comment('状态，0：开启配置，1：关闭配置');
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
        Schema::drop('base_configs');
    }
}
