<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId): User
    {
        return User::where('id', $userId)->first();
    }

}
