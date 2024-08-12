<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId): User;

    /**
     * @return Collection<int, User>
     */
    public function getAllUsers(): Collection;


}
