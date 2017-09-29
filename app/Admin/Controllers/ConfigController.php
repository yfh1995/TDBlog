<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/29
 * Time: 10:58
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Configs;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class ConfigController extends Controller {

    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header(multilingual('backend.configs.title'));
            $content->description(multilingual('backend.configs.description'));

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header(multilingual('backend.configs.title'));
            $content->description(multilingual('backend.configs.edit'));

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header(multilingual('backend.configs.title'));
            $content->description(multilingual('backend.configs.add'));

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Configs::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->key(multilingual('backend.configs.key'));
            $grid->value(multilingual('backend.configs.value'));

            $grid->created_at(multilingual('backend.configs.created_at'));
            $grid->updated_at(multilingual('backend.configs.updated_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Configs::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('key',multilingual('backend.configs.key'))->rules('required|unique:admin_configs');
            $form->text('value',multilingual('backend.configs.value'))->rules('required');

            $form->display('created_at', multilingual('backend.configs.created_at'));
            $form->display('updated_at', multilingual('backend.configs.updated_at'));
        });
    }
}