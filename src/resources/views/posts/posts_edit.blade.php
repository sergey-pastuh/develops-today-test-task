@extends('layout.app')

@section('content')

<form action="{{route('posts.edit', ['post_id' => $post->id])}}" method="POST">
	@method('PUT')
	@csrf
	<div class="post-form">
		<label for="title">Title</label>
		<input value="{{$post->title}}" type="text" name="title">
		<label for="link">Link</label>
		<input value="{{$post->link}}" type="text" name="link">
		<br>
		<input type="hidden" name="wasEdited" value="{{$post->id}}">
		<button type="submit">Edit post</button>
		@if($errors->has('title') || $errors->has('link'))
		    <div class="error">{{ $errors->first('title') }}</div>
		    <br>
		    <div class="error">{{ $errors->first('link') }}</div>
		@endif
	</div>
</form>

@endsection