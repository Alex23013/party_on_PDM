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
Route::get('/techs', 'TuserController@index');
Route::get('/techs/remove/{id}', 'TuserController@delete');
Route::get('/techs/{id}/active', 'TuserController@active');
Route::get('/techs/{id}/deactive', 'TuserController@deactive');
Route::get('/techs/add', 'TuserController@add');
Route::post('/techs', 'TuserController@store');
Route::get('/techs/edit/{id}', 'TuserController@update');
Route::post('/techs/edit', 'TuserController@store_update');

//Partners
Route::get('/partners', 'PartnerController@index');
Route::get('/partners/detail/{id}', 'PartnerController@detail');
Route::get('/partners/add', 'PartnerController@add');
Route::post('/partners', 'PartnerController@store');
Route::get('/partners/remove/{id}', 'PartnerController@delete');
Route::get('/partners/edit/{id}', 'PartnerController@update');
Route::post('/partners/edit', 'PartnerController@store_update');

//admin
Route::get('/users', 'UserController@index');
Route::get('/users/add/{role}', 'UserController@add');
Route::get('/users/{id}/active', 'UserController@active');
Route::get('/users/{id}/deactive', 'UserController@deactive');
Route::post('/users', 'UserController@store');
Route::get('/users/profile/edit', 'UserController@update');
Route::post('/users/profile/edit', 'UserController@store_update');
Route::post('/users/image_profile/edit', 'UserController@storeImageProfile');
Route::get('/users/see/{id}', 'UserController@detail');
Route::get('/users/edit/{id}', 'UserController@user_update');
Route::post('/users/edit/', 'UserController@store_user_update');
Route::get('/users/especific/edit', 'UserController@especific_edit');
Route::post('/users/especific/edit', 'UserController@store_especific_edit');
Route::get('/users/remove/{id}', 'UserController@delete');