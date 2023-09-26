<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mainpart'],function(){
    Route::get('test', 'MainpartController@getTest');
    Route::post('create', 'MainpartController@create');	
    Route::get('all', 'MainpartController@getAll');
    Route::put('update/{id}', 'MainpartController@update');
    Route::delete('delete/{id}', 'MainpartController@delete');
    Route::get('getbyid/{id}', 'MainpartController@get');
});