<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId): User
    {
        return User::where('id', $userId)->first();
    }

    public function getAllUsers(): Collection
    {
        return User::all();
    }

}
