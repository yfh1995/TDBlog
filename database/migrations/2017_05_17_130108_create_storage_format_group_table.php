<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 云盘模块数据表
 *
 * 云盘文件格式组信息表
 */
class CreateStorageFormatGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_format_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('文件分类名');
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
        Schema::drop('storage_format_group');
    }
}
