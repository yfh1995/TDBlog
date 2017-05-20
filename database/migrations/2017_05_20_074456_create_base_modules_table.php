<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 记录模块信息
 */
class CreateBaseModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('模块名');
            $table->integer('icon')->comment('图标id');
            $table->string('description')->nullable()->comment('描述');
            $table->string('url')->comment('模块链接');
            $table->integer('sort')->default(0)->comment('排序');
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
        Schema::drop('base_modules');
    }
}
