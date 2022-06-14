<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostsService;

class PostsController extends Controller
{
    public function home(Request $request) {
        //getting paginated posts for home page
        return view('posts.home', ['posts' => PostsService::getPostsForHome()]);
    }
}
