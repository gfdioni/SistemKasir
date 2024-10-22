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



Route::post("/login/action","AuthController@login");
Route::get("/login", [
    "uses"  => "LoginController@login_page",
    "as"    => "login_page",
]);
Route::get("/", "IndexController@index");
Route::get("/home", "IndexController@home");
