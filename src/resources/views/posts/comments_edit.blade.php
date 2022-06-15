@extends('layout.app')

@section('content')

	<div class="news-block">
		<div class="block-title">
			<a href="{{$comment->post->link}}">{{$comment->post->title}}</a>		
		</div>
		<div class="block-info">
			Likes: {{$comment->post->amount_of_upvotes}} | Author: {{$comment->post->author_name}} | Date: {{$comment->post->created_at}}
		</div>
	</div>

	<form method="UPDATE" class="comment-form" action="{{route('comments.edit', ['post_id' => $comment->post->id, 'comment_id' => $comment->id])}}">
		@method('PUT')
		@csrf
		<textarea class="comment-textarea" name="content">{{$comment->content}}</textarea>
		<button class="comment-button" type="submit">Edit Comment</button>
		<input type="hidden" name="post_id" value="{{$comment->post->id}}">
		<input type="hidden" name="wasEdited" value="{{$comment->id}}">
		@if($errors->has('content'))
		    <div class="error">{{ $errors->first('content') }}</div>
		@endif
	</form>

@endsection