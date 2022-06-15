<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentsService;
use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\EditCommentRequest;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function all(int $post_id) {
        //getting comments data && info about post
        $commentsData = CommentsService::getCommentsForPost($post_id);
        return view('posts.comments', $commentsData);
    }

    public function add(AddCommentRequest $request) {
        //adding comment to post
        $data = $request->validated();
        CommentsService::addComment($data);

        return redirect()->route('comments.all', ['post_id' => $data['post_id']]);
    }
    
    public function edit(int $post_id, int $comment_id, EditCommentRequest $request) {
        //displaying page for comment editing || accessing logic for comment editing
        if (isset($request->wasEdited)) {
            $data = $request->validated();
            CommentsService::editComment($data);

            return redirect()->route('comments.all', ['post_id' => $data['post_id']]);
        }

        $commentData = CommentsService::getComment($comment_id);

        return view('posts.comments_edit', ['comment' => $commentData]);
    }
    public function delete(int $post_id, int $comment_id) {
        //deleting a comment
        CommentsService::deleteComment($comment_id);

        return redirect()->route('comments.all', ['post_id' => $post_id]);
    }
}
