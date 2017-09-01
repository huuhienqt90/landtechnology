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
    Route::get('/', 'IndexController@index')->name('front.index');

    // Register
    Route::get('register', 'UserController@create')->name('front.user.create');
    Route::post('register', 'UserController@store')->name('front.user.store');
    // Login
    Route::get('login', 'UserController@showLogin')->name('front.user.login');
    Route::post('login', 'UserController@doLogin')->name('front.user.doLogin');
    // Logout
    Route::get('logout', 'UserController@logout')->name('front.user.logout');
    // Login by social
    Route::get('/redirect/{driver}', 'SocialAuthController@redirect')->name('front.social.login');
    Route::get('/callback/{driver}', 'SocialAuthController@callback');

    // PRODUCTS
    Route::group(['prefix' => 'product'], function(){
        // Route::resource('products', 'ProductController');
        Route::get('detail', 'ProductController@edit')->name('front.product.detail');
        Route::get('list', 'ProductController@showList')->name('front.product.list');
        Route::get('grid', 'ProductController@showGrid')->name('front.product.grid');
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'user'], function(){
        // Index dashboard
         Route::get('dashboard', 'DashboardController@index')->name('front.dashboard.index');

         // Edit Account Infomation
         Route::get('edit', 'UserController@edit')->name('front.user.edit');
         Route::post('edit', 'UserController@update')->name('front.user.update');
         // Password
         Route::get('editpass', 'UserController@editPass')->name('front.user.editPass');
         Route::post('editpass', 'UserController@updatePass')->name('front.user.updatePass');

    });
});

