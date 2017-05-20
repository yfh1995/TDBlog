<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 权限表
 */
class CreateBasePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('父权限id');
            $table->string('name')->comment('权限名');
            $table->string('comment')->comment('注释');
            $table->integer('sort')->default(0)->comment('排序，同一父权限下有效');
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
        Schema::drop('base_permissions');
    }
}
