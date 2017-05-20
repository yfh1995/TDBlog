<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 记录数据表更改情况
 */
class CreateBaseTableVersionChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_table_version_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('old_version_code')->comment('旧版本号');
            $table->integer('new_version_code')->comment('新版本号');
            $table->integer('table_id')->comment('做出改变的数据id');
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
        Schema::drop('base_table_version_changes');
    }
}
