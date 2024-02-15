<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
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

Route::post('/signup',              [AuthController::class, 'signup']);
Route::post('/signin',              [AuthController::class, 'signin']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/signout',          [AuthController::class, 'signout']);

    Route::group(['prefix' => 'categories'], function (){
        Route::get('/{category}',       [CategoryController::class, 'get']);
        Route::get('/',                 [CategoryController::class, 'index']);
        Route::post('/',                [CategoryController::class, 'create']);
        Route::patch('/{category}',     [CategoryController::class, 'patch']);
        Route::put('/{category}',       [CategoryController::class, 'put']);
        Route::delete('/{category}',    [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'projects'], function() {
        Route::get('/{project}',            [ProjectController::class, 'get']);
        Route::post('/',                    [ProjectController::class, 'create']);
        Route::delete('/{project}',         [ProjectController::class, 'delete']);
        Route::patch('/{project}',          [ProjectController::class, 'patch']);

        Route::get('/{project}/download',   [ProjectController::class, 'download']);
    });
});

