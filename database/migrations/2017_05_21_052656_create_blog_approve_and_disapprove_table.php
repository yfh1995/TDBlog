<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 博客模块数据表
 *
 * 用户对博客文章、回复的推荐与不推荐关系表
 */
class CreateBlogApproveAndDisapproveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_approve_and_disapprove', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->integer('object_id')->comment('操作对象id，对象为文章时，为文章id，对象为评论时，为评论id');
            $table->tinyInteger('type')->comment('操作类型，0：文章推荐，1：文章不推荐，2：评论推荐，3：评论不推荐');
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
        Schema::drop('blog_approve_and_disapprove');
    }
}
