<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 权限、用户映射表
 */
class CreateBasePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_permission_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->comment('权限id');
            $table->integer('user_id')->comment('用户id');
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
        Schema::drop('base_permission_user');
    }
}
