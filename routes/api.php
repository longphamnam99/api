<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/user/register', 'App\Http\Controllers\ApiUserController@register');
Route::post('/user/login', 'App\Http\Controllers\ApiUserController@login');
Route::get('/user/info', 'App\Http\Controllers\ApiUserController@info');
Route::get('/user/refresh', 'App\Http\Controllers\ApiUserController@refresh');
Route::fallback(function () {
    return json_encode([
        'status' => 400,
        'message' => 'Can not find method.'
    ]);
});

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/user/login', [ApiUserController::class, 'login']);
//     Route::post('/user/register', [ApiUserController::class, 'register']);
//     Route::post('/user/logout', [ApiUserController::class, 'logout']);
//     Route::post('/user/info', [ApiUserController::class, 'info']);    
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
