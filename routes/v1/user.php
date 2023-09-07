<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MachineOrderController;

Route::group(['prefix' => 'user'], function (){
    Route::get('id/{id}', 'UserController@getUserID');
    Route::get('all', 'UserController@getallUser');
    Route::post('adduser', 'UserController@addUser');
    Route::put('updateuser/{id}', 'UserController@updateUser');
    Route::delete('deleteuser/{id}', 'UserController@deleteUser');

});