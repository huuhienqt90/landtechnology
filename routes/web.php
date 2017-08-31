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
Auth::routes();

Route::group(['namespace' => 'Front'], function() {
	Route::get('/', 'IndexController@index')->name('index');

	// Register Seller
	Route::get('register', 'UserController@create')->name('user.create');
    Route::post('register', 'UserController@store')->name('user.store');

    Route::get('login', 'UserController@showLogin')->name('login');
    Route::post('login', 'UserController@doLogin')->name('doLogin');

    Route::get('logout', 'UserController@logout')->name('logout');

    // Login by social
    Route::get('/redirect/{driver}', 'SocialAuthController@redirect');
	Route::get('/callback/{driver}', 'SocialAuthController@callback');
});

