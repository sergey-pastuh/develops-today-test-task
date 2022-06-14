<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentsService;
use App\Http\Requests\AddCommentRequest;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function all(int $post_id) {
        //getting comments data && info about post
        $commentsData = CommentsService::getCommentsForPost($post_id);
        return view('posts.comments', $commentsData);
    }

    public function add(AddCommentRequest $request) {
        $data = $request->validated();
        CommentsService::addComment($data);

        return redirect("/posts/{$data['post_id']}/comments");
    }        
}
