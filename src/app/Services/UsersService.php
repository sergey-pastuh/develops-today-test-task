<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersService {

	public static function loginUser($credentials) {
		$user = User::where('name', $credentials['nickname'])
					->first();

		if ($user && Hash::check($credentials['password'], $user->password)) {
			Auth::login($user);

			return true;
		}

		return false; 
	}

	public static function registerUser($credentials) {
		$user = User::where('name', $credentials['nickname'])->first();

		if ($user) {
			return false;
		} 

		$user = User::create([
			'name' => $credentials['nickname'],
			'password' => $credentials['password']
		]);
		
		Auth::login($user);

		return true;
	}

	public static function logoutUser() {
		Auth::logout();

		return true; 
	}	
}