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

Route::group(['middleware' => ['guest'], 'prefix' => 'user'], function ($router) {
    Route::post('/reg', [\App\Http\Controllers\UserController::class, 'create']);
    Route::post('/auth', [\App\Http\Controllers\UserController::class, 'authorization']);
});
Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function ($router) {
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout']);
    Route::post('/addImage', [\App\Http\Controllers\UserController::class, 'addImage']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'posts'], function ($router) {
    Route::post('/create', [\App\Http\Controllers\PostController::class, 'create']);
    Route::get('/read/{post_id}/get', [\App\Http\Controllers\PostController::class, 'read']);
    Route::post('/update/{post_id}', [\App\Http\Controllers\PostController::class, 'update']);
    Route::delete('/destroy/{post_id}', [\App\Http\Controllers\PostController::class, 'destroy']);

    Route::get('/read', [\App\Http\Controllers\PostController::class, 'readAll']);
    Route::get('/read/sort', [\App\Http\Controllers\PostController::class, 'readSort']);
    Route::get('/read/filter', [\App\Http\Controllers\PostController::class, 'readFilter']);
    Route::get('/read/get', [\App\Http\Controllers\PostController::class, 'readGet']);

});

