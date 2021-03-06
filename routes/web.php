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

Route::get('/', 'test\TestController@show')->name('testing');
Route::get('testget', 'test\TestController@getDataGet');
Route::post('testpost', 'test\TestController@getDataPost');
Route::post('result', 'test\TestController@getResult');
Route::get('adminDrop', 'test\TestController@adminDrop');