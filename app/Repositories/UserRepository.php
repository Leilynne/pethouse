<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{

    public function getUserById(int $userId): User
    {
        return User::where('id', $userId)->first();
    }

    public function getAllUsers(int $page = 1, array $filters = []): LengthAwarePaginator
    {
        $builder = User::orderBy('name');

        if (isset($filters['name'])) {
            $builder->where('name', 'ILIKE', '%'.$filters['name'].'%');
        }

        return $builder->paginate(24, ['*'], 'page', $page);
    }
}
