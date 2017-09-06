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
    Route::get('check/login', 'UserController@showLogin')->name('login');
    Route::get('login', 'UserController@showLogin')->name('front.user.login');
    Route::post('login', 'UserController@doLogin')->name('front.user.doLogin');
    // Logout
    Route::get('logout', 'UserController@logout')->name('front.user.logout');
    // Login by social
    Route::get('/redirect/{driver}', 'SocialAuthController@redirect')->name('front.social.login');
    Route::get('/callback/{driver}', 'SocialAuthController@callback');
    // Verify
    Route::get('verify/{id?}', 'UserController@showVerify')->name('front.user.verify');
    Route::post('verify/{id?}', 'UserController@verify')->name('front.user.doVerify');

    // PRODUCTS
    Route::group(['prefix' => 'product'], function(){

        // Route::resource('products', 'ProductController');
        Route::get('detail/{slug?}', 'ProductController@show')->name('front.product.detail');
        Route::get('add-to-cart/{id?}/{quantity?}', 'ProductController@addToCart')->name('front.product.addToCart');
        Route::get('add-to-favorite/{id?}', 'ProductController@addToFavorite')->name('front.product.addToFavorite');
        Route::get('remove-from-cart/{id?}', 'ProductController@removeFromCart')->name('front.product.removeFromCart');
        Route::get('category/{slug?}', 'ProductController@productCategory')->name('front.product.category');
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

         // Seller Dashboard
         Route::resource('seller', 'SellerController');
    });
});

