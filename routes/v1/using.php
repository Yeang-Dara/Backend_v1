<?php
 use Illuminate\Support\Facades\Route;

 Route::group(['prefix' => 'using'], function(){
        Route::post('create', 'UsingController@create');
        Route::get('all', 'UsingController@getAll');
        Route::get('getid/{id}', 'UsingController@getID');
        Route::put('update/{id}', 'UsingController@update');
        Route::delete('delete/{id}', 'UsingController@delete');
        Route::get('total' , 'UsingController@getTotal');
        Route::get('active', 'UsingController@getActive');
        Route::get('nonactive', 'UsingController@getNonactive');
        Route::post('fiterdata', 'UsingController@getmuliusing');
        Route::post('datatable', 'UsingController@dataTable');
        Route::get('type', 'UsingController@type');
        Route::get('warranty/{id}', 'UsingController@getWarranty');
        Route::get('report', 'UsingController@getReport');
        Route::get('export', 'UsingController@export');
        Route::post('import', 'UsingController@importData');
 });
