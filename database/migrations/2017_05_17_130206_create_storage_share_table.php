<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 云盘模块数据表
 *
 * 云盘分享表
 */
class CreateStorageShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_share', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->comment('描述');
            $table->string('share_code')->comment('分享码');
            $table->integer('catalog_id')->comment('分享目录id');
            $table->integer('user_id')->comment('分享者id');
            $table->timestamp('deadline')->comment('分享截至时间');
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
        Schema::drop('storage_share');
    }
}
