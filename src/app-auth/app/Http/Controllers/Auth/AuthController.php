<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    function login(Request $request)
    {
        return 'login';
    }

    function registration(Request $request)
    {
        $valid = $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);

        $result = $this->authService->saveRecord($valid);

        return response()->json($result, 200);
    }

    function logout()
    {
        return "logout";
    }
}
