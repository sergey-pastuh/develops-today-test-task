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
			Likes: {{$post->amount_of_upvotes}} | Author: {{$post->author_name}} | Date: {{$post->created_at}} | <a href="/posts/{{$post->id}}/comments">
				@if ($post->comments_count > 0)
					Comments: {{$post->comments_count}}
				@else
					Discuss
				@endif</a> 	
		</div>
	</div>
	@endforeach
	<div></div>
	@include('layout.pagination', ['paginator' => $posts->appends(request()->except('page'))])

@endsection