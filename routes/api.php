<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function (){
    Route::post('login', 'App\Http\Controllers\Auth\Api\Auth\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\Auth\Api\Auth\AuthController@logout');
    route::post('register', 'App\Http\Controllers\Auth\Api\Auth\AuthController@register');
});

Route::apiResource('/news', \App\Http\Controllers\Auth\Api\NewsController::class)
    ->middleware('auth:sanctum');

Route::apiResource('/categories', \App\Http\Controllers\Auth\Api\CategoryController::class)
    ->middleware('auth:sanctum');
