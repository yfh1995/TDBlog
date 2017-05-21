<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 博客模块数据表
 *
 * 博客回复列表
 */
class CreateBlogReplysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_replys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->comment('文章id');
            $table->integer('user_id')->comment('回复者id');
            $table->integer('to_id')->comment('回复对象id');
            $table->text('content')->comment('回复内容');
            $table->integer('approve_amount')->default(0)->comment('赞同数');
            $table->integer('disapprove_amount')->default(0)->comment('不赞同数');
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
        Schema::drop('blog_replys');
    }
}
