<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostsService;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\AddPostPageRequest;
use App\Http\Requests\EditPostRequest;

class PostsController extends Controller
{
    public function home(Request $request) {
        //getting paginated posts for home page
        return view('posts.home', ['posts' => PostsService::getPostsForHome($request)]);
    }

    public function newPostPage(AddPostPageRequest $request) {
        //rendering view for adding new post page
        return view('posts.posts_new');
    }

    public function add(AddPostRequest $request) {
        //adding a new post
        $data = $request->validated();
        PostsService::addPost($data);

        return redirect()->route('posts.home');
    }

    public function edit(int $post_id, EditPostRequest $request) {
        //displaying page for post editing || accessing logic for post editing
        if (isset($request->wasEdited)) {
            $data = $request->validated();
            PostsService::editPost($data);

            return redirect()->route('posts.home');
        }

        $postData = PostsService::getPost($post_id);

        return view('posts.posts_edit', ['post' => $postData]);
    }

    public function delete(int $post_id) {
        //deleting a post
        PostsService::deletePost($post_id);

        return redirect()->route('posts.home');
    }

    public function upvote(int $post_id) {
        //deleting a post
        PostsService::upvotePost($post_id);

        return redirect()->route('posts.home');
    }    
}
