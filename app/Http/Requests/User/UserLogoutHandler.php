<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Models\User;

readonly class UserLogoutHandler
{
    public function handle(User $user):void
    {
        $user->tokens()
            ->where('token', $user->currentAccessToken()->token)
            ->delete();
    }

}
