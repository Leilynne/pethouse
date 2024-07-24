<?php

namespace App\Repositories;

use App\Enums\UserRole;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @return Collection<int, User>
     */
    public function getAllUsers(): Collection;

    /**
     * @throws UserNotFoundException
     */
    public function getUserById(int $id): User;


    /**
     * @param UserRole $role
     * @return Collection<int, User>
     */
    public function getUsersByRole(UserRole $role): Collection;
}
