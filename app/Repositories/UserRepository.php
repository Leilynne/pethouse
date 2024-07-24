<?php

namespace App\Repositories;

use App\Enums\UserRole;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getUserById(int $id): User
    {
        return User::where(['id' => $id])->first() ?? throw new UserNotFoundException();
    }

    public function getUsersByRole(UserRole $role): Collection
    {
        return User::where(['role' => $role])->get();
    }
}
