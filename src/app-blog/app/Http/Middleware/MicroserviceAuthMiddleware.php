<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MicroserviceAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        try {
            $hasToken = $request->cookie($request->cookieHangus);

            throw_if(!$hasToken || !$request->cookieHangus || !auth()->check(), new HttpException(403, 'Unauthorized'));

            $token = json_decode($hasToken, true);
            $result = resolve(AuthService::class)->retrieveById($token);
            $newToken = $result['refresh_token'];
            $cookie = cookie($request->cookieHangus, json_encode($newToken), $newToken['expires_in']);
            return $next($request)->withCookie($cookie);

        } catch (Exception $e) {
            Cookie::queue(Cookie::forget(request()->cookieHangus));
            return redirect()->route('login')->withErrors(['message' => 'Please Login']);
        }
    }
}
