<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId): User;

    /**
     *
     */
    public function getAllUsers(int $page = 1, array $filters = []): LengthAwarePaginator;


}
