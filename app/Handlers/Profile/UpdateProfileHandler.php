<?php

declare(strict_types = 1);

namespace App\Handlers\Profile;

use App\DTO\UserDTO;
use App\Handlers\User\UserUpdate\UserUpdateCommand;
use App\Mappers\UserMapper;

readonly class UpdateProfileHandler
{
    public function handle(UserUpdateCommand $command): UserDTO
    {
        $command->user->update([
            'name' => $command->name,
            'email' => $command->email,
            'phone' => $command->phone,
        ]);

        return UserMapper::mapModelToDTO($command->user);
    }
}
