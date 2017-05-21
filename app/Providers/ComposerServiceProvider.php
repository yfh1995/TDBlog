<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/21
 * Time: 21:41
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider{

    /**
     * 在容器内注册所有绑定。
     *
     * @return void
     */
    public function boot()
    {
        // 使用对象型态的视图组件...
        view()->composer('backend.includes.menu', 'App\Http\ViewComposers\Backend\Base\MenuComposer');
    }

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function register()
    {
        //
    }
}