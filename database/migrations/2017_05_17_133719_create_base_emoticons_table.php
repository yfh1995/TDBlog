<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 表情包信息
 */
class CreateBaseEmoticonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_emoticons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->comment('所属表情包组');
            $table->string('name')->comment('表情名');
            $table->integer('file_id')->comment('表情图片id');
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
        Schema::drop('base_emoticons');
    }
}
