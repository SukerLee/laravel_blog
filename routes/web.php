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

Route::get('admin/login','Admin\LoginController@login');

Route::get('admin/code','Admin\LoginController@code');

Route::get('admin/getcode','Admin\LoginController@getcode');

