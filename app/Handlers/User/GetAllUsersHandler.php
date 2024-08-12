<?php

declare(strict_types=1);

namespace App\Handlers\User;

use App\DTO\UserDTO;
use App\Mappers\UserMapper;
use App\Repositories\UserRepositoryInterface;

readonly class GetAllUsersHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){
    }

    /**
     * @return UserDTO[]
     */
    public function handle(): array
    {
        return UserMapper::mapModelsToDTOArray($this->userRepository->getAllUsers());
    }

}
