<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PostsService;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\AddPostPageRequest;
use App\Http\Requests\EditPostRequest;

class PostsController extends Controller
{
    public function home(Request $request)
    {
        //getting paginated posts for home page
        return PostsService::getPostsForHome();
    }


    public function add(Request $request)
    {
        //adding a new post
        $data = $request->all();

        return PostsService::addPost($data);
    }

    public function edit(int $post_id, Request $request)
    {
        //displaying page for post editing || accessing logic for post editing
        $data = $request->all();
        $data['wasEdited'] = $post_id;

        return PostsService::editPost($data);
    }

    public function delete(int $post_id)
    {
        //deleting a post
        return PostsService::deletePost($post_id);
        ;
    }

    public function upvote(int $post_id)
    {
        //deleting a post
        PostsService::upvotePost($post_id);

        return redirect()->route('posts.home');
    }
}
