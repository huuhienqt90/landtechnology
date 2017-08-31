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
	Route::get('register', 'UserController@create')->name('front.user.create');
    Route::post('register', 'UserController@store')->name('front.user.store');

    Route::get('login', 'UserController@showLogin')->name('front.user.login');
    Route::post('login', 'UserController@doLogin')->name('front.user.doLogin');

    Route::get('logout', 'UserController@logout')->name('front.user.logout');

    // Login by social
    Route::get('/redirect/{driver}', 'SocialAuthController@redirect');
	Route::get('/callback/{driver}', 'SocialAuthController@callback');

    Route::group(['middleware' => 'auth', 'prefix' => 'user'], function(){
        
    });

    // PRODUCTS
    Route::group(['prefix' => 'product'], function(){
        // Route::resource('products', 'ProductController');
        Route::get('detail', 'ProductController@edit')->name('front.product.detail');
    });
});

