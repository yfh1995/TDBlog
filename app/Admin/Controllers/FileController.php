<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/29
 * Time: 13:37
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Files;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FileController extends Controller{

    public function index(){

        return Admin::content(function(Content $content){

            $content->header(multilingual('backend.files.title'));
            $content->description(multilingual('backend.files.description'));

            $content->body($this->grid());
        });
    }

    protected function grid(){

        return Admin::grid(Files::class, function(Grid $grid){

            $grid->id('ID')->sortable();

            $grid->name(multilingual('backend.files.name'));
            $grid->path(multilingual('backend.files.path'));
            $grid->size(multilingual('backend.files.size'));
            $grid->format(multilingual('backend.files.format'));
            $grid->md5(multilingual('backend.files.md5'));
            $grid->download_num(multilingual('backend.files.download_num'));

            $grid->created_at(multilingual('backend.files.created_at'));
            $grid->updated_at(multilingual('backend.files.updated_at'));

            $grid->disableActions();
        });

    }
}