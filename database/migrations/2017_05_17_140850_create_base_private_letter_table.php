<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 记录网站消息（包含私人消息、群发消息和系统消息）
 */
class CreateBasePrivateLetterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_private_letter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from')->comment('消息发出者');
            $table->integer('to')->comment('消息接收者');
            $table->string('title')->comment('消息标题');
            $table->text('content')->comment('消息主体');
            $table->tinyInteger('type')->comment('0：全站信息，1：私人信息');
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
        Schema::drop('base_private_letter');
    }
}
