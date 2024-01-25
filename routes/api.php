<?php

use App\Http\Controllers\CategoryController;
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

Route::group(['prefix' => 'categories'], function (){
    Route::get('/{category}',       [CategoryController::class, 'get']);
    Route::get('/',                 [CategoryController::class, 'index']);
    Route::post('/',                [CategoryController::class, 'create']);
    Route::patch('/{category}',     [CategoryController::class, 'patch']);
    Route::put('/{category}',       [CategoryController::class, 'put']);
    Route::delete('/{category}',    [CategoryController::class, 'delete']);
});
