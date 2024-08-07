<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OptionalAuth
{
    /**
     * @throws HttpException
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (null !== $token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if (null !== $accessToken) {
                Auth::login($accessToken->tokenable);
            }
        }

        return $next($request);
    }
}
