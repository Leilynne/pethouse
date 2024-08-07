<?php

declare(strict_types=1);

namespace App\Handlers\User;

use App\Models\User;
use App\Repositories\UserRepository;

readonly class UserShowHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ){
    }

    public function handle(int $userId): User
    {
        return $this->userRepository->getUserById($userId);
    }
}
