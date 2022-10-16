<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MicroserviceGuestMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()) {
            return redirect()->route('blogs.index');
        }
        return $next($request);

    }
}
