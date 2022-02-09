<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Modules\Admin\Http\Controllers\AdminController;
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


    Route::get('/admin/', [AdminController::class,'index']);
    Route::get('/admin/{admin}/', [AdminController::class,'show']);
    Route::put('/admin/{admin}/edit', [AdminController::class,'update']);
    Route::delete('/admin/{admin}/destroy', [AdminController::class,'delete']);


    Route::post('/register', [AdminController::class, 'register']);

