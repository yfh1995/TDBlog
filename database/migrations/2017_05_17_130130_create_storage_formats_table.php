<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 云盘模块数据表
 *
 * 云盘文件格式表
 */
class CreateStorageFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_formats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->comment('文件类型分组id');
            $table->string('name')->comment('格式名，如png');
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
        Schema::drop('storage_formats');
    }
}
