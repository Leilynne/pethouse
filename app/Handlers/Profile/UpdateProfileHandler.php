<?php

declare(strict_types = 1);

namespace App\Handlers\Profile;

use App\Models\User;
use Auth;

readonly class UpdateProfileHandler
{
    public function handle(array $data): User
    {
        $user = Auth::user();
        $user->update($data);

        return $user;
    }
}
