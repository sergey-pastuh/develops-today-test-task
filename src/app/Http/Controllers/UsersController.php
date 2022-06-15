<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UsersService;


class UsersController extends Controller
{
    public function authPage() {
        //displaying auth page
        return view('user.auth');
    }

    public function login(LoginRequest $request) {
        //logging user in system
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
        //registering new user
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
        //logging user out of system
        UsersService::logoutUser();
        
        return redirect("/");
    }    
}
