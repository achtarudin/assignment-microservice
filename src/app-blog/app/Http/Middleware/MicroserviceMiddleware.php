<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\Blog\MicroserviceException;

class MicroserviceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authRoute = [
            route('login'),
            route('registration'),
        ];

        $serverAuth     = config('microservice.server_auth');
        $cookieHangus   = config('microservice.cookie_name');

        // check request url in array authRoute
        if (in_array($request->url(), $authRoute)) {
            throw_if(!$serverAuth || !$cookieHangus, new MicroserviceException(500, 'Server auth not found'));
        }

        $request->merge([
            'serverAuth'    => $serverAuth,
            'cookieHangus'  => $cookieHangus
        ]);
        return $next($request);
    }
}
