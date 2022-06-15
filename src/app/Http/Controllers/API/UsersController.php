<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UsersService;


class UsersController extends Controller
{
    public function login(Request $request) {
        //logging user in system
        $credentials = [
            'nickname' => $request->nickname, 
            'password' => $request->password
        ];

        return UsersService::loginUser($credentials);
    }

    public function register(Request $request) {
        //registering new user
        $credentials = [
            'nickname' => $request->nickname, 
            'password' => $request->password,
        ];
        
        return UsersService::registerUser($credentials);
    }

    public function logout() {
        //logging user out of system
        return UsersService::logoutUser();
    }    
}
