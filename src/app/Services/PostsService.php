<?php

namespace App\Services;

use App\Models\Post;

class PostsService {

	public static function getPostsForHome() {
		return Post::withCount('comments')->orderBy('created_at', 'DESC')->paginate(25);
	}
}