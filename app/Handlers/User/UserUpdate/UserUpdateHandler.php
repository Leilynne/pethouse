<?php

declare(strict_types=1);

namespace App\Handlers\User\UserUpdate;

use App\DTO\UserDTO;
use App\Mappers\UserMapper;
use App\Repositories\UserRepositoryInterface;

readonly class UserUpdateHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){
    }

    public function handle(UserUpdateByAdminCommand $command): UserDTO
    {
        $user = $this->userRepository->getUserById($command->userId);
        $user->update([
            'name' => $command->name,
            'email' => $command->email,
            'phone' => $command->phone,
            'text' => $command->text,
        ]);

        return UserMapper::mapModelToDTO($user);
    }

}
