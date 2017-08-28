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

Route::resource('users', 'UsersController');

