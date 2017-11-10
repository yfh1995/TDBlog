<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'],function(){

    //登录
    Route::post('login','AuthController@login');

    Route::group(['middleware'=>'auth:api'],function(){

        //通用邮件发送接口
        Route::post('/sendEmail','EmailController@sendEmail');
    });

    //============================工具方法=========================
    Route::group(['prefix'=>'tool'],function(){

        //强制更新后台configs缓存
        Route::get('/updateBackendConfigsCache','ToolController@updateBackendConfigsCache');

    });

});