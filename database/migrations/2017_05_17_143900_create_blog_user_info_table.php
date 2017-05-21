<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 博客模块数据表
 *
 * 博客模块用户信息表
 */
class CreateBlogUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_num')->default(0)->comment('发表文章数量');
            $table->integer('reply_num')->default(0)->comment('评论数');
            $table->integer('received_reply_num')->default(0)->comment('被评论数');
            $table->integer('read_num')->default(0)->comment('被阅读量');
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
        Schema::drop('blog_user_info');
    }
}
