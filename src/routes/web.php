<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Home

Route::controller(PostsController::class)->group(function () {
    Route::get('/', 'home');
});

Route::controller(CommentsController::class)->group(function () {
    Route::get('/posts/{post_id}/comments', 'all');
    Route::post('/posts/{post_id}/comments/add', 'add');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/users/auth', 'authPage');
    Route::post('/users/auth/login', 'login');
    Route::post('/users/auth/register', 'register');
    Route::get('/users/auth/logout', 'logout');
});