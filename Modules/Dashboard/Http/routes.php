<?php

Route::group(['middleware' => ['web'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('login', 'AuthController@showLoginForm')->name('login.Admin');
    Route::post('login', 'AuthController@postLoginForm')->name('login.Admin.post');
    Route::get('logout', 'AuthController@logout')->name('logout.Admin');

    Route::group(['middleware' => 'check.auth:Admin', 'as' => 'dashboard.'], function(){
        Route::get('/', 'DashboardController@index');
        Route::resource('category', 'CategoryController');
        Route::resource('brand', 'BrandController');
        Route::resource('sell-type', 'SellTypeController');
        Route::resource('seller-shipping', 'SellerShippingController');
        Route::resource('attribute', 'AttributeController');
        Route::resource('product', 'ProductController');
        Route::resource('attribute-group', 'AttributeGroupController');
        Route::resource('attribute', 'AttributeController');

        Route::resource('setting', 'SettingController');
        Route::resource('payment-method', 'PaymentMethodController');
        Route::resource('role', 'RoleController');
        Route::resource('user', 'UserController');

    });

});
