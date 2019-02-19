<?php

/*Route::group(['middleware' => 'web', 'prefix' => 'base', 'namespace' => 'Modules\Base\Http\Controllers'], function()
{
    Route::get('/', 'BaseController@index');
});
*/
Route::group(['middleware' => 'web', 'prefix' => 'base', 'namespace' => 'Modules\Base\Http\Controllers'], function()
{
   Route::group(['middleware' => 'language'], function () {
    Route::group(['middleware' => 'auth'], function () {
         Route::group(['middleware' => 'adminmenu'], function () {
    
    Route::resource('unidades', 'Unidades');
   Route::post('unidades/import', 'Unidades@import')->name('unidades.import');
    Route::get('unidades/export', 'Unidades@export')->name('unidades.export');
      
    Route::resource('items', 'Items');
   Route::post('items/import', 'Items@import')->name('items.import');
    Route::get('items/export', 'Items@export')->name('items.export');
      
    
    Route::group(['as' => 'modals.',  'prefix' => 'modals'], function () {
                Route::resource('categories', 'Modals\Categories');  
                Route::resource('unidades', 'Modals\Unidades');
            });
    
    
         });
    });
   });
    
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