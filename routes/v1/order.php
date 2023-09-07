<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'order'], function (){
    Route::post('create', 'OrderController@create');
    Route::get('all', 'OrderController@getall');
    Route::put('update/{id}', 'OrderController@update');
    Route::delete('delete/{id}', 'OrderController@delete');
    Route::get('getorder', 'OrderController@getOrder');
    Route::get('ownorder/{id}','orderController@ownOrder');
    Route::get('total','orderController@total');
    Route::delete('deleteorder/{id}','orderController@deleteItem');
    // Route::put('edit/{id}', 'OrderController@editOrder');

});