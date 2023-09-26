<?php 

use ILluminate\Support\Facades\Route;

Route::group(['prefix' => 'spareparts'], function(){
    Route::get('test1','SparepartController@test1');
});