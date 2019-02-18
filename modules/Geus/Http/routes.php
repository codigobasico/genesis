<?php

Route::group(['middleware' => 'web', 'prefix' => 'geus', 'namespace' => 'Modules\Geus\Http\Controllers'], function()
{
    Route::get('/', 'GeusController@index');
});
