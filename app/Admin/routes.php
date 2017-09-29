<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web','auth','checkPermissions:BackendIndex','admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    //配置管理
    $router->resource('auth/configs','ConfigController');

    //文件管理
    $router->resource('auth/files','FileController');

});
