<?php

declare(strict_types=1);

namespace App\Handlers\User;

use App\DTO\UserDTO;
use App\Mappers\UserMapper;
use App\Repositories\UserRepositoryInterface;

readonly class UserShowHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){
    }

    public function handle(int $userId): UserDTO
    {
        return UserMapper::mapModelToDTO($this->userRepository->getUserById($userId));
    }
}
