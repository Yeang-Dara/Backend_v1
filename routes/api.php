<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Resources\UserResource;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return new ($request->user());
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
});


$router->group(['prefix' => 'v1'], function () {
    require __DIR__ . '/v1/order.php';
    require __DIR__ . '/v1/user.php';
    require __DIR__ . '/v1/using.php';
    require __DIR__ . '/v1/stock.php';
    require __DIR__ . '/v1/mainpart.php';
    require __DIR__ . '/v1/maintenace.php';
    require __DIR__ . '/v1/spareparts.php';
  
   
});

// Route::get('getData', [ReplaceMainpartController::class, 'test']);

 
   
