<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    function login(Request $request)
    {
        return 'login';
    }

    function registration(Request $request)
    {
        return "registration";
    }

    function logout()
    {
        return "logout";
    }
}
