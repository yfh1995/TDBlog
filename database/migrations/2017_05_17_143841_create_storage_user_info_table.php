<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 云盘模块数据表
 *
 * 用户云盘信息
 */
class CreateStorageUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('used_space')->default(0)->comment('已使用空间');
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
        Schema::drop('storage_user_info');
    }
}
