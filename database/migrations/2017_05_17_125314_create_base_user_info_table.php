<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 基础数据表
 *
 * 网站用户基础信息表
 */
class CreateBaseUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('用户名');
            $table->string('phone')->nullable()->comment('电话');
            $table->string('address')->nullable()->comment('联系地址');
            $table->string('avatar')->comment('头像');
            $table->string('banner')->comment('背景图');
            $table->integer('theme')->default(0)->comment('主题');
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
        Schema::drop('base_user_info');
    }
}
