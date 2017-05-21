<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 博客模块数据表
 *
 * 博客文章分类列表
 */
class CreateBlogArticleGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->comment('分类拥有者id');
            $table->string('name')->comment('文章分组名');
            $table->integer('article_num')->default(0)->comment('分组文章数量');
            $table->string('description')->nullable()->comment('描述');
            $table->integer('sort')->default(0)->comment('排序');
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
        Schema::drop('blog_article_group');
    }
}
