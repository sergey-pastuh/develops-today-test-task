@extends('layout.app')

@section('content')

<form action="{{route('posts.add')}}" method="POST">
	@csrf
	<div class="post-form">
		<label for="title">Title</label>
		<input type="text" name="title">
		<label for="link">Link</label>
		<input type="text" name="link">
		<br>
		<button type="submit">Add new post</button>
		@if($errors->has('title') || $errors->has('link'))
		    <div class="error">{{ $errors->first('title') }}</div>
		    <br>
		    <div class="error">{{ $errors->first('link') }}</div>
		@endif
	</div>
</form>

@endsection