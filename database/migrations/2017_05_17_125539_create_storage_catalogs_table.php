<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 云盘模块数据表
 *
 * 云盘目录信息表
 */
class CreateStorageCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->comment('拥有者id');
            $table->integer('parent_id')->default(0)->comment('父目录id');
            $table->string('name')->comment('目录名');
            $table->integer('download_num')->default(0)->comment('下载数量');
            $table->bigInteger('size')->default(-1)->comment('目录大小');
            $table->boolean('is_file')->default(false)->comment('false：目录，true：文件');
            $table->string('format')->nullable()->comment('格式，如：png，若为目录则为空');
            $table->softDeletes();
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
        Schema::drop('storage_catalogs');
    }
}
