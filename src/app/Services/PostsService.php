<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PostsService {

	public static function getPostsForHome($request) {
		$posts = Post::withCount('comments');
		$sorting = $request->sortedBy ?? false;

		switch ($sorting) {
			case 'comments':
				$posts->orderBy('comments_count', 'DESC');
				break;

			case 'likes':
				$posts->orderBy('amount_of_upvotes', 'DESC');
				break;
			
			default:
				$posts->orderBy('created_at', 'DESC');
				break;
		}
		return $posts->orderBy('title')
					->paginate(25);
	}

	public static function getPost(int $post_id) {
		$post = Post::find($post_id);

		return $post;
	}

	public static function addPost(array $data) {
		$post = Post::create([
			'title' => $data['title'],
			'author_name' => Auth::user()->name ?? $data['username'],
			'link' => $data['link']
		]);

		return $post;
	}

	public static function editPost(array $data) {
		$post = Post::find($data['wasEdited']);

		//bypassing login logic for api routes because unfortunally didn't have time to implement that
		if (Auth::user()) {
			if ($post->author_name == Auth::user()->name) {
				$post->title = $data['title'];
				$post->link = $data['link'];
				$post->save();
			}
		} else {
			$post->title = $data['title'];
			$post->link = $data['link'];
			$post->save();
		}

		return $post;
	}

	public static function deletePost(int $post_id) {
		$post = Post::find($post_id);
		//bypassing login logic for api routes because unfortunally didn't have time to implement that
		if (Auth::user()) {
			if ($post->author_name == Auth::user()?->name) {
				$post->delete();
			}
		} else {
			$post->delete();
		}

		return $post;
	}

	public static function upvotePost(int $post_id) {
		$post = Post::find($post_id);
		$post->amount_of_upvotes++;
		$post->save();

        $redis = Redis::connection();
        $upvotedUsers = $redis->command('HGET', ['upvoted-posts', $post_id]);

        if (!empty($upvotedUsers)) {
        	$upvotedUsers = array_push($upvotedUsers, Auth::id());
        } else {
        	$upvotedUsers = [Auth::id()];
        }

        $redis->command('HSET', ['upvoted-posts',$post_id, json_encode($upvotedUsers)]);

		return true;
	}	
}