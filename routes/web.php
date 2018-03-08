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
Route::any('/getBanks', 'Banks\BanksGet@getBanks');
Route::get('/getBanks', 'Banks\BanksGet@getBanks');
Route::get('/file', 'File\FileForm');
Route::get('/migrate', function () {
    Artisan::call('migrate', [
        '--force' => true,
    ]);
});
Route::post('/fileAdd', 'File\FileAdd');
Route::post('/delBanks', 'Banks\BanksDel@delBanks');
Route::post('/editBanks', 'Banks\BanksEdit@editBanks');
//Route::get('adminDrop', 'test\TestController@adminDrop');
Route::get('/404', function () {
    return view('404.404');
})->name('404');