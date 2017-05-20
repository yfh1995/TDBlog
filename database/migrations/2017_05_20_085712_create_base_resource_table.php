<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 基础资源信息表，如：网盘里不同文件后缀的文件图标
 */
class CreateBaseResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_resource', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->comment('模型id');
            $table->string('key')->unique()->comment('资源对应的键');
            $table->string('value')->comment('资源对应的值');
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
        Schema::drop('base_resource');
    }
}
