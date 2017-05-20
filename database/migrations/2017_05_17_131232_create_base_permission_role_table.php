<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 权限、角色映射表
 */
class CreateBasePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->comment('权限id');
            $table->integer('role_id')->comment('角色id');
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
        Schema::drop('base_permission_role');
    }
}
