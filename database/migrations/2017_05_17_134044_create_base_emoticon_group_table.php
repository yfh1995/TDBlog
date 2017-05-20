<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 网站表情包组信息
 */
class CreateBaseEmoticonGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_emoticon_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('表情包组组名');
            $table->integer('sort')->comment('排序，同一表情包组下有效');
            $table->integer('owner_id')->default(0)->comment('拥有者，0：系统');
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
        Schema::drop('base_emoticon_group');
    }
}
