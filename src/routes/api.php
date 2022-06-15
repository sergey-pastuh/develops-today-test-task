<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostsController;
use App\Http\Controllers\API\CommentsController;
use App\Http\Controllers\API\UsersController;

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

defined( 'GET_PUT' ) or define( 'GET_PUT', [ 'get', 'put' ] );

Route::controller(PostsController::class)->group(function () {
    Route::get('/home', 'home');
    Route::post('/posts/add', 'add');
    Route::match(GET_PUT, '/posts/{post_id}/edit', 'edit');
    Route::delete('/posts/{post_id}/delete', 'delete');
    Route::post('/posts/{post_id}/upvote', 'upvote');
});

Route::controller(CommentsController::class)->group(function () {
    Route::get('/posts/{post_id}/comments', 'all');
    Route::post('/posts/{post_id}/comments/add', 'add');
    Route::match(GET_PUT, '/posts/{post_id}/comments/{comment_id}/edit', 'edit');
    Route::delete('/posts/{post_id}/comments/{comment_id}/delete', 'delete');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/users/auth', 'authPage');
    Route::post('/users/auth/login', 'login');
    Route::post('/users/auth/register', 'register');
    Route::post('/users/auth/logout', 'logout');
});