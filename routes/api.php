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

Route::get('/', function () {
    return response()->json([
        "code" => 200,
        "message" => "Welcome to DTSoft API"
    ]);
});
Route::post('/user/register', 'App\Http\Controllers\api\Users@register');
Route::post('/user/login', 'App\Http\Controllers\api\Users@login');
Route::post('/user/logout', 'App\Http\Controllers\api\Users@logout');
Route::get('/user/info', 'App\Http\Controllers\api\Users@info');
Route::get('/user/refresh', 'App\Http\Controllers\api\Users@refresh');

Route::post('/news/add_category', 'App\Http\Controllers\api\News@add_category');
Route::get('/news/list_category', 'App\Http\Controllers\api\News@list_category');
Route::put('/news/edit_category/{id}', 'App\Http\Controllers\api\News@edit_category');
Route::delete('/news/delete_category/{id}', 'App\Http\Controllers\api\News@delete_category');

Route::get('/news/list_post', 'App\Http\Controllers\api\News@list_post');
Route::post('/news/add_post', 'App\Http\Controllers\api\News@add_post');
Route::put('/news/edit_post/{id}', 'App\Http\Controllers\api\News@edit_post');
Route::delete('/news/delete_post/{id}', 'App\Http\Controllers\api\News@delete_post');

Route::get('/product/list_category', 'App\Http\Controllers\api\Product@list_category');
Route::post('/product/add_category', 'App\Http\Controllers\api\Product@add_category');
Route::put('/product/edit_category/{id}', 'App\Http\Controllers\api\Product@edit_category');
Route::delete('/product/delete_category/{id}', 'App\Http\Controllers\api\Product@delete_category');

Route::get('/product/list_post', 'App\Http\Controllers\api\Product@list_post');
Route::post('/product/add_post', 'App\Http\Controllers\api\Product@add_post');
Route::put('/product/edit_post/{id}', 'App\Http\Controllers\api\Product@edit_post');
Route::delete('/product/delete_post/{id}', 'App\Http\Controllers\api\Product@delete_post');

Route::fallback(function () {
    return json_encode([
        'code' => 400,
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
