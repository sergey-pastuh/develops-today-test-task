<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\CommentsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\EditCommentRequest;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function all(int $post_id) {
        //getting comments data && info about post
        return CommentsService::getCommentsForPost($post_id);
    }

    public function add(int $post_id, Request $request) {
        //adding comment to post
        $data = $request->all();
        $data['post_id'] = $post_id;
        return CommentsService::addComment($data);
    }
    
    public function edit(int $post_id, int $comment_id, Request $request) {
        //displaying page for comment editing || accessing logic for comment editing
        $data = $request->all();
        $data['wasEdited'] = $comment_id;
        
        return CommentsService::editComment($data);
    }
    public function delete(int $post_id, int $comment_id) {
        //deleting a comment
        return CommentsService::deleteComment($comment_id);
    }
}
