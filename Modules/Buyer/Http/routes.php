<?php
Route::group(['middleware' => ['web'], 'prefix' => 'buyer', 'namespace' => 'Modules\Buyer\Http\Controllers'], function()
{
    Route::get('/login', 'BuyerController@index')->name('login.Buyer');
    Route::group(['middleware' => 'check.auth:Buyer'], function(){
        Route::get('/', 'BuyerController@index');
    });
});
