<?php

use Illuminate\Http\Request;
Use \Modules\Blog\Http\Controllers\CommentController;
Use \Modules\Blog\Http\Controllers\PostController;
Use \Modules\Blog\Http\Controllers\CategoryController;

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

Route::group(['middleware' => ['auth:admin-api','role:super-admin|can:manage posts']], function () {
    route::apiResource('post', 'PostController');
});

Route::group(['middleware' => ['auth:admin-api','role:super-admin|can:manage categories']], function () {
    route::apiResource('category', 'CategoryController');
});

Route::group(['middleware' => ['auth:admin-api']], function () {
    route::apiResource('comment', 'CommentController');
});

