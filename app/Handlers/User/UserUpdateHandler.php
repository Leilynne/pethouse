<?php

declare(strict_types=1);

namespace App\Handlers\User;

use App\Models\User;
use App\Repositories\UserRepository;

readonly class UserUpdateHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ){
    }

    public function handle(array $data, int $userId): User
    {
        $user = $this->userRepository->getUserById($userId);
        $user->update($data);

        return $user;
    }

}
