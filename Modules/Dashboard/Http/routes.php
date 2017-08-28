<?php

Route::group(['middleware' => ['web'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('/login', 'DashboardController@index')->name('login.Admin');
    Route::group(['middleware' => 'check.auth:Admin'], function(){
        Route::get('/', 'DashboardController@index');
    });

});
