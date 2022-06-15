<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentsService {

	public static function getCommentsForPost(int $post_id) {
		$comments = Comment::where('post_id', $post_id)->orderBy('created_at', 'DESC')->get();
        $post = Post::find($post_id);

		return ['comments' => $comments, 'post' => $post];
	}

	public static function getComment(int $comment_id) {
		$comment = Comment::where('id', $comment_id)->with('post')->first();

		return $comment;
	}	

	public static function addComment(array $data) {
		$comment = Comment::create([
			'post_id' => $data['post_id'],
			'author_name' => Auth::user()->name ?? $data['username'],
			'content' => $data['content']
		]);

		return $comment;
	}

	public static function editComment(array $data) {
		$comment = Comment::find($data['wasEdited']);
		//bypassing login logic for api routes because unfortunally didn't have time to implement that
		if (Auth::user()) {
			if ($comment->author_name == Auth::user()->name) {
				$comment->content = $data['content'];
				$comment->save();
			}
		} else {
			$comment->content = $data['content'];
			$comment->save();
		}

		return $comment;
	}

	public static function deleteComment(int $comment_id) {
		$comment = Comment::find($comment_id);
		//bypassing login logic for api routes because unfortunally didn't have time to implement that
		if (Auth::user()) {
			if ($comment->author_name == Auth::user()->name) {
				$comment->delete();
			}
		} else {
			$comment->delete();
		}
		return $comment;
	}	
}