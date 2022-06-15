@extends('layout.app')

@section('content')

<form action="{{route('auth.login')}}" method="POST">
	@csrf
	<h1>Login</h1>
	<div class="auth-form">
		<label for="login_nickname">Nickname</label>
		<input type="text" name="login_nickname">
		<label for="login_password">Password</label>
		<input type="password" name="login_password">
		<input type="hidden" name="auth_type" value="login">
		<br>
		<button type="submit">Login</button>
		@if($errors->has('login_nickname') || $errors->has('login_password'))
		    <div class="error">{{ $errors->first('login_nickname') }}</div>
		    <br>
		    <div class="error">{{ $errors->first('login_password') }}</div>
		@endif
	</div>
</form>
<hr>
<form action="{{route('auth.register')}}" method="POST">
	@csrf
	<div class="auth-form">
		<h1>Register</h1>
		<label for="register_nickname">Nickname</label>
		<input type="text" name="register_nickname">
		<label for="register_password">Password</label>
		<input type="password" name="register_password">
		<label for="register_repeated_password">Repeat password</label>
		<input type="password" name="register_repeated_password">	
		<input type="hidden" name="auth_type" value="register">
		<br>
		<button type="submit">Register</button>
		@if($errors->has('register_nickname') || $errors->has('register_password') || $errors->has('register_repeated_password'))
		    <div class="error">{{ $errors->first('register_nickname') }}</div>
		    <br>
		    <div class="error">{{ $errors->first('register_password') }}</div>
		    <br>
		    <div class="error">{{ $errors->first('register_repeated_password') }}</div>
		@endif
	</div>
</form>
@endsection