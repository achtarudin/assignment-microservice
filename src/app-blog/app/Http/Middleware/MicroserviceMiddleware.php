<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\Blog\MicroserviceException;

class MicroserviceMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $serverAuth     = config('microservice.server_auth');
        $cookieHangus   = config('microservice.cookie_name');

        throw_if(!$serverAuth || !$cookieHangus, new MicroserviceException(500, 'Server auth not found'));
        $request->merge([
            'serverAuth'    => $serverAuth,
            'cookieHangus'  => $cookieHangus
        ]);
        return $next($request);
    }
}
