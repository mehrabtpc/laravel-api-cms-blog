<?php

use Illuminate\Http\Request;

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
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:admin-api']], function () {
    Route::get('/user/profile/', [AuthController::class,'showProfile']);
    Route::post('/user/edit/', [AuthController::class,'editProfile']);
    Route::get('/user/delete-account', [AuthController::class,'deleteProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
