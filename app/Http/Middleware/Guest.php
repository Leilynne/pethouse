<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Guest
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
                throw new HttpException(403, 'Already authenticated.');
            }
        }

        return $next($request);
    }
}
