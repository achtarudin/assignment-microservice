<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;

class AuthController extends Controller
{
    function login(Request $request)
    {
        return 'login';
    }

    function registration(Request $request)
    {
        $valid = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        return "registration";
    }

    function logout()
    {
        return "logout";
    }
}
