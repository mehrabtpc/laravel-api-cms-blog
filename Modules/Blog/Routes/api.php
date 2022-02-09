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

route::apiResource('category','CategoryController');
route::apiResource('comment','CommentController');
route::apiResource('post','PostController');

