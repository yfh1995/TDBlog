<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 博客模块数据表
 *
 * 博客文章收藏列表
 */
class CreateBlogArticleQualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_quality', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('收藏者id');
            $table->integer('article_id')->comment('收藏文章id');
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
        Schema::drop('blog_article_quality');
    }
}
