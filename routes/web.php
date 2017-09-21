<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test','IndexController@index');

Route::any('admin/login','Admin\LoginController@login');



Route::get('admin/crypt','Admin\LoginController@crypt');
Route::get('admin/code','Admin\LoginController@code');
Route::get('admin','Admin\IndexController@index');

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function (){
    
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('logout','LoginController@logout');
    Route::any('pass','IndexController@pass');
    
    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    Route::resource('category', 'CategoryController');
    
    Route::resource('article', 'ArticleController');
    
    Route::any('upload','CommonController@upload');
});

