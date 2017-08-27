<?php

Route::group(['middleware' => 'web', 'prefix' => 'seller', 'namespace' => 'Modules\Seller\Http\Controllers'], function()
{
    Route::get('/', 'SellerController@index');
});
