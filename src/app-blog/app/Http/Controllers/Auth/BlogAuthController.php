<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Auth\BlogLoginRequest;
use App\Http\Requests\Auth\BlogRegistrationRequest;

class BlogAuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(BlogLoginRequest $request)
    {
        $valid = $request->validated();
        $serverAuth = request()->serverAuth;
        $response = Http::post("{$serverAuth}/login", $valid);

        if($response->successful()){
            $expiresIn = $response->json('expires_in');
            $cookie = cookie($request->cookieHangus, $response->body(), $expiresIn);
            return redirect()->route('blogs.index')->withCookie($cookie);
        }
        return redirect()->back()->withInput()->withErrors($response->json());
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postRegistration(BlogRegistrationRequest $request)
    {
        $valid = $request->validated();
        $serverAuth = request()->serverAuth;
        $response = Http::post("{$serverAuth}/registration", $valid);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Registration success');
        }
        return redirect()->back()->withInput()->withErrors($response->json());
    }
}
