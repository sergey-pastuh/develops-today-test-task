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

defined( 'GET_PUT' ) or define( 'GET_PUT', [ 'get', 'put' ] );

Route::controller(PostsController::class)->group(function () {
    Route::get('/', 'home')->name('posts.home');
    Route::get('/posts/new', 'newPostPage')->name('posts.new');
    Route::post('/posts/add', 'add')->name('posts.add');
    Route::match(GET_PUT, '/posts/{post_id}/edit', 'edit')->name('posts.edit');
    Route::delete('/posts/{post_id}/delete', 'delete')->name('posts.delete');
    Route::post('/posts/{post_id}/upvote', 'upvote')->name('posts.upvote');
});

Route::controller(CommentsController::class)->group(function () {
    Route::get('/posts/{post_id}/comments', 'all')->name('comments.all');
    Route::post('/posts/{post_id}/comments/add', 'add')->name('comments.add');
    Route::match(GET_PUT, '/posts/{post_id}/comments/{comment_id}/edit', 'edit')->name('comments.edit');
    Route::delete('/posts/{post_id}/comments/{comment_id}/delete', 'delete')->name('comments.delete');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/users/auth', 'authPage')->name('auth.page');
    Route::post('/users/auth/login', 'login')->name('auth.login');
    Route::post('/users/auth/register', 'register')->name('auth.register');
    Route::post('/users/auth/logout', 'logout')->name('auth.logout');
});