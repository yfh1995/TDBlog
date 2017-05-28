<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::group(['middleware'=>'web'],function(){

    Route::group(['middleware'=>'guest','namespace'=>'Auth'],function(){
        Route::get('/login','AuthController@getLogin');
        Route::post('/login','AuthController@postLogin');
        Route::get('/register','AuthController@getRegister');
        Route::post('/register','AuthController@postRegister');
        Route::get('/activate/{code}','AuthController@activate');
    });

    Route::group(['middleware'=>'auth'],function() {

        Route::get('/', function () {
            return view('welcome');
        });
        Route::get('/logout','Auth\AuthController@getLogout');


    });
//});



Route::get('tt','TestController@index');
