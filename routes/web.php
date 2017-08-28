<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| ->name()路由别名
|
*/
//首页
Route::get('/','StaticPagesController@home')->name('home');
//帮助
Route::get('/help','StaticPagesController@help')->name('help');
//关于
Route::get('/about','StaticPagesController@about')->name('about');
//注册
Route::get('signup','UsersController@create')->name('signup');
//resource 资源路由
/**
 *  GET	/users	UsersController@index	显示所有用户列表的页面
    GET	/users/{user}	UsersController@show	显示用户个人信息的页面
    GET	/users/create	UsersController@create	创建用户的页面
    POST	/users	UsersController@store	创建用户
    GET	/users/{user}/edit	UsersController@edit	编辑用户个人资料的页面
    PATCH	/users/{user}	UsersController@update	更新用户
    DELETE	/users/{user}	UsersController@destroy	删除用户
 */
Route::resource('users', 'UsersController');

//用户登录
Route::get('login','SessionsController@create')->name('login');//显示登录
Route::post('login','SessionsController@store')->name('login');//创建登录
Route::delete('logout','SessionsController@destroy')->name('logout');//销毁登录


