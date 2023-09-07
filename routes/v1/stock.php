<?php


use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'stock'], function(){
    Route::post('addstock', 'StockController@create');
    Route::put('updatestock/{id}', 'StockController@update');
    Route::delete('deletestock/{id}', 'StockController@delete');
    Route::get('getstock/{id}', 'StockController@getdata');
});