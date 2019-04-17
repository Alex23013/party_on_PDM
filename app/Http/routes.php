<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/users', 'UserController@index');
Route::get('/users/add', 'UserController@add');
//Route::get('users/{id}', 'UserController@show');
Route::post('users', 'UserController@store');
//Route::put('users/{id}', 'UserController@update');
Route::get('/users/remove/{id}', 'UserController@delete');