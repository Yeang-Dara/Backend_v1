<?php 
 use Illuminate\Support\Facades\Route;
  
 Route::group(['prefix' =>'maintenace'], function(){
    Route::get('test', 'MaintenaceController@gettest');
    Route::post('create', 'MaintenaceController@create');
    Route::put('update/{id}', 'MaintenaceController@update');
    Route::get('getbyid/{id}', 'MaintenaceController@getData');
    Route::get('all', 'MaintenaceController@getAll');
    Route::delete('delete/{id}', 'MaintenaceController@delete');
    
 });