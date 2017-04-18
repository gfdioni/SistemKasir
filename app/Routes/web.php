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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',array("uses"=>"LoginController@login","as"=>"logizn"));
Route::post('login',array("uses"=>"LoginController@action","as"=>"login"));

Route::get('aaa',function(){Artisan::call('migrate',['--force'=>true]);});
