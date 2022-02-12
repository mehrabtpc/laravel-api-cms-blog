<?php

use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\UserController;
use Laravel\Sanctum\HasApiTokens;

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

Route::group(['middleware' => ['auth:admin-api']], function () {
    Route::get('/admin/', [AdminController::class,'index']);
    Route::get('/admin/{admin}/', [AdminController::class,'show']);
    Route::put('/admin/{admin}/edit', [AdminController::class,'update']);
    Route::delete('/admin/{admin}/destroy', [AdminController::class,'delete']);
    Route::post('/storeUser', [AdminController::class, 'storeUser']);
    Route::apiResource('role','RoleController');
});
