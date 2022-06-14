<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentsService {

	public static function getCommentsForPost(int $id) {
		$comments = Comment::where('post_id', $id)->orderBy('created_at', 'DESC')->get();
        $post = Post::find($id);

		return ['comments' => $comments, 'post' => $post];
	}

	public static function addComment(array $data) {
		Comment::create([
			'post_id' => $data['post_id'],
			'author_name' => Auth::user() ? Auth::user()->nickname : 'Anon',
			'content' => $data['content']
		]);

		return true;
	}	
}