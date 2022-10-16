<?php

namespace App\Providers;

use Exception;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\MicroserviceMiddleware;
use App\Http\Middleware\MicroserviceAuthMiddleware;
use App\Http\Middleware\MicroserviceGuestMiddleware;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        app('router')->aliasMiddleware('microservice', MicroserviceMiddleware::class);
        app('router')->aliasMiddleware('microservice.guest', MicroserviceGuestMiddleware::class);
        app('router')->aliasMiddleware('microservice.auth', MicroserviceAuthMiddleware::class);

        // merge the auth config
        config(['auth.guards.blog.driver' => 'blog-token']);
        config(['auth.defaults.guard'    => 'blog']);

        Auth::viaRequest('blog-token', function (Request $request) {
            try {
                $hasToken = $request->cookie($request->cookieHangus);
                if ($hasToken && $request->cookieHangus) {
                    $token = json_decode($hasToken, true);
                    $result = resolve(AuthService::class)->retrieveById($token);
                    return new GenericUser($result['user']);
                }
            } catch (Exception $th) {
                return null;
            }
        });

    }
}
