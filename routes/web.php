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

Route::group(['middleware' => 'auth'], function() {
	
	Route::redirect('/', '/me', 301);
	Route::redirect('/home', '/me', 301);
	Route::get('/me', 'DashboardController@show')->name('home');
	Route::get('/users/{user}/profile', 'UserController@profile');
	Route::patch('/users/{user}/profile', 'UserController@profile_update');

	Route::group(['middleware' => 'admin'], function() {
		
		Route::get('/clients', 'MyClientController@index');
		Route::post('/clients', 'MyClientController@store');
		Route::get('/clients/create', 'MyClientController@create');
		Route::get('/clients/{client}', 'MyClientController@show');
		Route::get('/clients/{client}/delete', 'MyClientController@delete');
		Route::delete('/clients/{client}', 'MyClientController@destroy');

		Route::get('/groups', 'GroupController@index');
		Route::get('/groups/create', 'GroupController@create');
		Route::post('/groups', 'GroupController@store');
		Route::get('/groups/{group}/edit', 'GroupController@edit');
		Route::patch('/groups/{group}', 'GroupController@update');
		Route::get('/groups/{group}/delete', 'GroupController@delete');
		Route::delete('/groups', 'GroupController@destroy');

		Route::post('/users/import', 'ImportController@upload');
		Route::get('/users/import', 'ImportController@show');
		Route::get('/users', 'UserController@index');
		Route::get('/users/create', 'UserController@create');
		Route::post('/users', 'UserController@store');
		Route::get('/users/{user}/edit', 'UserController@edit');
		Route::patch('/users/{user}', 'UserController@update');
		Route::get('/users/{user}/delete', 'UserController@delete');
		Route::delete('/users', 'UserController@destroy');

	});
});


Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', '\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset');
