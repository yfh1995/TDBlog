<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 博客模块数据表
 *
 * 博客文章数据表
 */
class CreateBlogArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('作者id');
            $table->integer('group_id')->default(0)->comment('文章分组id');
            $table->string('title')->comment('文章标题');
            $table->text('content')->comment('内容');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('read_amount')->default(0)->comment('阅读量');
            $table->integer('reply_amount')->default(0)->comment('回复量');
            $table->integer('approve_amount')->default(0)->comment('赞同数');
            $table->integer('disapprove_amount')->default(0)->comment('不赞同数');
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
        Schema::drop('blog_articles');
    }
}
