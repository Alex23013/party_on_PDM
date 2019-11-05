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
Route::get('/home', 'HomeController@index');


//End-points routes
Route::post('/api/v1/user_login', 'RestUserController@login');
Route::post('/api/v1/user_register', 'RestUserController@register');
Route::post('/api/v1/user_reset_password', 'RestUserController@resetPass');

Route::post('/api/v1/create_party', 'RestUserController@createParty');
Route::get('/api/v1/get_pool', 'RestUserController@getPool');

Route::get('/playsong/{id}', 'RestUserController@play');
