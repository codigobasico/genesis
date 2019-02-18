<?php

/*Route::group(['middleware' => 'web', 'prefix' => 'base', 'namespace' => 'Modules\Base\Http\Controllers'], function()
{
    Route::get('/', 'BaseController@index');
});
*/
Route::group(['middleware' => 'web', 'prefix' => 'base', 'namespace' => 'Modules\Base\Http\Controllers'], function()
{
   Route::resource('unidades', 'Unidades');
   Route::post('unidades/import', 'Unidades@import')->name('unidades.import');
    Route::get('unidades/export', 'Unidades@export')->name('unidades.export');
                
});

/*
Route::group(['middleware' => 'web', 'prefix' => 'base', 'namespace' => 'Modules\Base\Http\Controllers'], function()
{
    Route::group(['middleware' => 'language'], function () {
    Route::group(['middleware' => 'auth'], function () {
         Route::group(['middleware' => 'adminmenu'], function () {
        
                    Route::get('/', 'BaseController@index');
                    Route::get('unidades', 'Unidades@index');
          });
        });
    });
});*/