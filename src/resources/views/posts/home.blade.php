@extends('layout.app')

@section('content')

	@php
		if (Request::get('page')) {
			$postNumberOnPage = 1 +(Request::get('page') - 1) * 25;
		} else {
			$postNumberOnPage = 1;
		}
	@endphp

	@foreach($posts as $post)

	<div class="news-block">
		<div class="block-number">
			{{$postNumberOnPage++}}.
		</div>
		<div class="block-pointer">
			&#9755;
		</div>		
		<div class="block-title">
			<a href="{{$post->link}}">{{$post->title}}</a>		
		</div>
		<div class="block-info">
			@auth 
				@if (!$post->is_liked_by_current_user) 
					<button class="link-button upvote-button" id="{{$post->id}}" type="submit">&#9709;</button>
				@else
					&nbsp;	&nbsp;
				@endif
			@endauth
			Likes: <div class="upvotes" id="upvotes-{{$post->id}}">{{$post->amount_of_upvotes}}</div> | Author: {{$post->author_name}} | Date: {{$post->created_at}} | <a href="{{route('comments.all', ['post_id' => $post->id])}}">
			@if ($post->comments_count > 0)
				Comments: {{$post->comments_count}}
			@else
				Discuss
			@endif</a>
			@if (auth()?->user()?->name == $post->author_name)
				 | 
				<form action="{{route('posts.edit', ['post_id' => $post->id])}}" method="GET">
				 	@csrf
					<button class="link-button" type="submit">Edit</button>
				</form>
				 | 
				 <form action="{{route('posts.delete', ['post_id' => $post->id])}}" method="POST">
				 	@method('DELETE')
				 	@csrf
					<button onclick=" return confirm('Are you sure you want to delete this post?')" class="link-button" type="submit">Delete</button>
				</form>
			@endif
		</div>
	</div>
	@endforeach
	<div></div>
	@include('layout.pagination', ['paginator' => $posts->appends(request()->except('page'))])

@endsection