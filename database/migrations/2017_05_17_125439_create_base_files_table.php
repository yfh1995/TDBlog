<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 全站文件信息表
 */
class CreateBaseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->comment('文件路径');
            $table->string('name')->comment('文件名');
            $table->bigInteger('size')->comment('大小');
            $table->string('format')->comment('后缀名');
            $table->string('md5')->comment('md5值');
            $table->integer('module_id')->comment('模块id');
            $table->integer('download_num')->default(0)->comment('下载量');
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
        Schema::drop('base_files');
    }
}
