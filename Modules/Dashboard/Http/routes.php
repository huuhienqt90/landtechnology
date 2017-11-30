<?php

Route::group(['middleware' => ['web'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('login', 'AuthController@showLoginForm')->name('login.Admin');
    Route::post('login', 'AuthController@postLoginForm')->name('login.Admin.post');
    Route::get('logout', 'AuthController@logout')->name('logout.Admin');

    Route::group(['middleware' => ['check.auth:Admin', 'check.auth:Seller'], 'as' => 'dashboard.'], function(){
        Route::get('/', 'DashboardController@index');
        // Category
        Route::resource('category', 'CategoryController');

        Route::resource('brand', 'BrandController');
        Route::resource('sell-type', 'SellTypeController');
        Route::resource('seller-shipping', 'SellerShippingController');
        Route::resource('attribute', 'AttributeController');
        Route::resource('country', 'CountryController');
        Route::resource('tag', 'TagController');
        // Product
        Route::resource('product', 'ProductController');
        // Delete Feature Image By Ajax
        Route::post('deleteimage/{id?}', 'ProductController@deleteImageByAjax')->name('delimg');
        // Delete Product Image By Ajax
        Route::post('deleteproductimage/{id?}', 'ProductController@deleteProductImageByAjax')->name('delProductImg');
        // Get Product By Name
        Route::get('getproduct','ProductController@getProductByName')->name('getproduct');
        // Get Product By ID
        Route::get('getproductbyid','ProductController@getProductById')->name('getproductid');

        Route::resource('attribute-group', 'AttributeGroupController');
        Route::resource('attribute', 'AttributeController');


        // Return json type attribute group
        Route::get('getattribute', 'ProductController@getAttribute')->name('getattr');
        // Add attribute quick
        Route::post('addfastattribute', 'ProductController@addFastAttribute')->name('addfast');

        Route::resource('setting', 'SettingController');
        Route::resource('payment-method', 'PaymentMethodController');
        Route::resource('role', 'RoleController');
        // User
        Route::resource('user', 'UserController');
        // Get customer user by name ajax
        Route::get('getcustomer','UserController@getCustomerUser')->name('getcustomer');
        // Get user fill billing details
        Route::get('getcustomerbyid', 'UserController@getInfoBill')->name('getcustomerbyid');
        // Delete Avatar User By Ajax
        Route::post('delavatar/{id?}','UserController@deleteAvatar')->name('delavatar');
        // Commission
        Route::resource('commission', 'CommissionController');
        // Get commission by product type and category
        Route::get('getcommission', 'CommissionController@getCommission')->name('getcommission');
        // Get cost commission by product type and category
        Route::get('getCostByCategory', 'CommissionController@getCostByCategory')->name('getcostbycategory');

        // Coupon
        Route::resource('coupon', 'CouponController');
        // Order
        Route::resource('order','OrderController');
        // Payment history
        Route::resource('payment-history','PaymentHistoryController');
        Route::get('paid/{id?}','PaymentHistoryController@paid')->name('paid');
        Route::get('deleteAttributeVariation','ProductController@delAttributeVariation')->name('delAttributeVariation');
    });

});
