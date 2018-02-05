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

Route::get('/', 'Banks\BanksShow')->name('show');
Route::post('/addBanks', 'Banks\BanksAdd@add');
Route::post('/getBanks', 'Banks\BanksGet@getBanks');
Route::post('/delBanks', 'Banks\BanksDel@delBanks');
Route::post('/editBanks', 'Banks\BanksEdit@editBanks');
//Route::get('adminDrop', 'test\TestController@adminDrop');