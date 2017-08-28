<?php

Route::group(['middleware' => ['web'], 'prefix' => 'seller', 'namespace' => 'Modules\Seller\Http\Controllers'], function()
{
    Route::get('/login', 'SellerController@index')->name('login.Seller');
    Route::group(['middleware' => 'check.auth:Seller'], function(){
        Route::get('/', 'SellerController@index');
    });

});
