<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 记录权限依赖情况
 */
class CreateBasePermissionDependenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_permission_dependence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->comment('权限id');
            $table->integer('parent_id')->comment('父权限id');
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
        Schema::drop('base_permission_dependence');
    }
}
