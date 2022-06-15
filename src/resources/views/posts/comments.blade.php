@extends('layout.app')

@section('content')

	<div class="news-block">
		<div class="block-title">
			<a href="{{$post->link}}">{{$post->title}}</a>		
		</div>
		<div class="block-info">
			Likes: {{$post->amount_of_upvotes}} | Author: {{$post->author_name}} | Date: {{$post->created_at}} | <a href="{{route('comments.all', ['post_id' => $post->id])}}">
				@if ($post->comments_count > 0)
					Comments: {{$post->comments_count}}
				@else
					Discuss
				@endif</a> 	
		</div>
	</div>

	<form method="POST" class="comment-form" action="{{route('comments.add', ['post_id' => $post->id])}}">
		@csrf
		<textarea class="comment-textarea" name="content"></textarea>
		<button class="comment-button" type="submit">Add Comment</button>
		<input type="hidden" name="post_id" value="{{$post->id}}">
		@if($errors->has('content'))
		    <div class="error">{{ $errors->first('content') }}</div>
		@endif
	</form>

	@php
		$commentsNumberOnPage = 1;
	@endphp

	@foreach($comments as $comment)

	<div class="news-block">
		<div class="block-number">
			{{$commentsNumberOnPage++}}.
		</div>	
		<div class="block-title">
			{{$comment->content}}	
		</div>
		<div class="block-info">
			Author: {{$comment->author_name}} | Date: {{$comment->created_at}}
			@if (auth()?->user()?->name == $comment->author_name)
			 |
			 <form action="{{route('comments.edit', ['post_id' => $post->id, 'comment_id' => $comment->id])}}" method="GET">
			 	@csrf
				<button class="link-button" type="submit">Edit</button>
			</form>
			 |
			 <form action="{{route('comments.delete', ['post_id' => $post->id, 'comment_id' => $comment->id])}}" method="POST">
			 	@method('DELETE')
			 	@csrf
				<button onclick=" return confirm('Are you sure you want to delete this comment?')" class="link-button" type="submit">Delete</button>
			</form>
			@endif
		</div>
	</div>
	@endforeach

@endsection