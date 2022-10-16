<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class MicroserviceGuestMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $hasToken = $request->cookie($request->cookieHangus);
        $token = null;
        $tokenNotExpired = false;

        if ($hasToken) {
            $token = json_decode($hasToken, true);
        }

        if ($token && isset($token['expires_in'])) {

            $todayTimestamp  =  now()->timestamp;
            $tokenExpIn = $token['expires_in'];
            $tokenNotExpired = $todayTimestamp < $tokenExpIn;
        }

        if($tokenNotExpired && isset($token['access_token'])) {

            $serverAuth = request()->serverAuth;
            $accessToken = $token['access_token'];

            $response = Http::withToken($accessToken)->post("{$serverAuth}/token-check");

            if($response->successful()) {
                return redirect()->route('blogs.index');
            }

            $cookie = Cookie::forget($request->cookieHangus);
            return $next($request)->withCookie($cookie);

        }

        $cookie = Cookie::forget($request->cookieHangus);
        return $next($request)->withCookie($cookie);    }
}
