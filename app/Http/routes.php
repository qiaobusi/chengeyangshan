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

Route::get('/', function () {
    return view('welcome');
});


//web
Route::controller('/web/index', 'Web\IndexController');


//manage
Route::controller('/manage/index', 'Manage\IndexController');
Route::controller('/manage/main', 'Manage\MainController');
Route::controller('/manage/user', 'Manage\UserController');
Route::controller('/manage/manager', 'Manage\ManagerController');


//api
Route::controller('/web/version100/app', 'Web\Version100\AppController');
