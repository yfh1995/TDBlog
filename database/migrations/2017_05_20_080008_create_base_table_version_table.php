<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 记录基础数据表版本情况
 */
class CreateBaseTableVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_table_version', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name')->comment('数据表名');
            $table->integer('version_code')->default(0)->comment('版本号');
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
        Schema::drop('base_table_version');
    }
}
