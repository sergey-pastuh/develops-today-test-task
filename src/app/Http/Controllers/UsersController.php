<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UsersService;


class UsersController extends Controller
{
    public function authPage() {
        return view('user.auth');
    }

    public function login(LoginRequest $request) {
        $credentials = [
            'nickname' => $request->login_nickname, 
            'password' => $request->login_password
        ];

        if (UsersService::loginUser($credentials)) {
            return redirect("/");
        } 

        return redirect("/users/auth");    
    }

    public function register(RegisterRequest $request) {
        $credentials = [
            'nickname' => $request->register_nickname, 
            'password' => $request->register_password,
        ];
        
        if (UsersService::registerUser($credentials)) {
            return redirect("/");
        } 

        return redirect("/users/auth");
    }

    public function logout() {
        UsersService::logoutUser();
        
        return redirect("/");
    }    
}
