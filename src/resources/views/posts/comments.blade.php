@extends('layout.app')

@section('content')

	<div class="news-block">
		<div class="block-title">
			<a href="{{$post->link}}">{{$post->title}}</a>		
		</div>
		<div class="block-info">
			Likes: {{$post->amount_of_upvotes}} | Author: {{$post->author_name}} | Date: {{$post->created_at}} | <a href="/posts/{{$post->id}}/comments">
				@if ($post->comments_count > 0)
					Comments: {{$post->comments_count}}
				@else
					Discuss
				@endif</a> 	
		</div>
	</div>

	<form method="POST" class="comment-form" action="/posts/{{$post->id}}/comments/add">
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
		</div>
	</div>
	@endforeach

@endsection