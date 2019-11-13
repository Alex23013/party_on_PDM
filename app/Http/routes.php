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
Route::get('/playsong/{id}','HomeController@player');
Route::get('/playsong/{id}', 'RestUserController@play');

//End-points routes
Route::post('/api/v1/user_login', 'RestUserController@login');
Route::post('/api/v1/user_register', 'RestUserController@register');
Route::post('/api/v1/user_reset_password', 'RestUserController@resetPass');

Route::post('/api/v1/create_party', 'RestPartyController@createParty');
Route::post('/api/v1/join_party', 'RestPartyController@joinParty');
Route::post('/api/v1/evaluate_near_parties', 'RestPartyController@evaluateNearParties');

Route::get('/api/v1/get_pool', 'RestPoolController@getPool');
Route::get('/api/v1/get_top_ten', 'RestPoolController@getTopTen');
