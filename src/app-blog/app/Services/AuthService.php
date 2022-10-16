<?php

namespace App\Services;

use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService implements UserProvider
{
    public function retrieveById($token): array
    {
        $serverAuth = request()->serverAuth;

        $todayTimestamp  =  now()->timestamp;

        $tokenExpIn      = $token['expires_in'] ?? null;

        $accessToken     = $token['access_token'] ?? null;

        throw_if(!$tokenExpIn || !$accessToken, new HttpException(403, 'Unauthorized'));

        $tokenNotExpired = $todayTimestamp < $tokenExpIn;

        throw_if(!$tokenNotExpired, new HttpException(403, 'Unauthorized'));

        $response = Http::withToken($accessToken)->post("{$serverAuth}/token-check");

        throw_if(!$response->successful(), new HttpException(500, 'Server error'));

        return $response->json();

    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    }
}
