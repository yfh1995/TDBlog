<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/29
 * Time: 15:56
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class EmoticonGroupController extends Controller {

    public function index(){

        return Admin::content(function(Content $content){

            $content->header(multilingual('backend.emoticon_group.title'));
            $content->description(multilingual('backend.emoticon_group.description'));

            $content->body($this->grid());

        });
    }

    public function grid(){

        return Admin::grid(function (Grid $grid){

            $grid->id('ID');

            $grid->name(multilingual('backend.emoticon_group.name'));
            $grid->owner_id(multilingual('backend.emoticon_group.owner_id'));

            $grid->created_at(multilingual('backend.emoticon_group.created_at'));
            $grid->updated_at(multilingual('backend.emoticon_group.updated_at'));

        });

    }

}