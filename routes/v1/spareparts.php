<?php 

use ILluminate\Support\Facades\Route;

Route::group(['prefix' => 'spareparts'], function(){
    Route::get('test1','SparepartController@test1');
    Route::post('create', 'SparepartController@create');
    Route::get('getdata', 'SparepartController@getData');
    Route::put('update/{id}', 'SparepartController@updateData');
    Route::delete('delete/{id}', 'SparepartController@delete');
});