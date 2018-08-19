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


Route::get('users', ['as' => 'users.index', 'uses' => 'UserController@index']);

Route::redirect('users/home', 'users', 301);

Route::view('users/welcome', 'welcome');