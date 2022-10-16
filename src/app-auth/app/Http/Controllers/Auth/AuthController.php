<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    function login(Request $request)
    {
        /**
         * validate login request
         */
        $credentials = $this->validate($request, [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required'
        ]);

        /**
         * check user by email
         */
        $user = $this->authService->findRecordBy(['email' => $credentials['email']])->first();

        throw_if(!$user, new HttpException(404, 'User Email Not Found'));

        /**
         * check user have valid password
         */
        $isValidPassword = Hash::check($credentials['password'], $user->password);

        throw_if(!$isValidPassword, new HttpException(404, 'User Email Not Found'));

        /**
         * generate token to user
         */
        $token = JWTAuth::fromUser($user);

        throw_if(!$token, new HttpException(500, "Failed Generate Token Email {$credentials['email']}"));

        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'expires_in'    =>  Carbon::now()->timestamp + config('jwt.ttl') * 60,
            'ttl'           =>  config('jwt.ttl'),
        ], 200, [
            'Content-Type' => 'application/json',
        ]);
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
        return response()->json(['logout'], 200);
    }

    function tokenCheck()
    {
        try {
            $getToken   = JWTAuth::getToken();
            $apy        = JWTAuth::getPayload($getToken)->toArray();
            $user       = $this->authService->findRecordBy(['id' => $apy['id']])->first();

            throw_if(!$user, new TokenInvalidException('Unauthorized', 401));

            $newToken = JWTAuth::fromUser($user);

            return response()->json([
                'user'          => $user->only('id', 'email', 'name'),
                'refresh_token' => [
                    'access_token'  => $newToken,
                    'token_type'    => 'Bearer',
                    'expires_in'    =>  Carbon::now()->timestamp + config('jwt.ttl') * 60,
                    'ttl'           =>  config('jwt.ttl'),
                ],
            ], 200, [
                'Content-Type' => 'application/json',
            ]);
        } catch (Exception $e) {
            throw ($e);
        }
    }
}
