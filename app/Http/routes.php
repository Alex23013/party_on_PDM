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

Route::get('/profile', 'UserController@profile');

// E-mail verification
Route::get('/register/verify/{id}/{code}', 'UserController@verify');

//Techs 
Route::get('/techs', 'TechController@index');

//admin
Route::get('/users', 'UserController@index');
Route::get('/users/add/{role}', 'UserController@add');
Route::get('/users/{id}/active', 'UserController@active');
Route::get('/users/{id}/deactive', 'UserController@deactive');
Route::post('/users', 'UserController@store');
Route::get('/users/profile/edit', 'UserController@update');
Route::post('/users/profile/edit', 'UserController@store_update');
Route::post('/users/image_profile/edit', 'UserController@storeImageProfile');
Route::get('/users/especific/edit', 'UserController@especific_edit');
Route::post('/users/especific/edit', 'UserController@store_especific_edit');
Route::get('/users/remove/{id}', 'UserController@delete');