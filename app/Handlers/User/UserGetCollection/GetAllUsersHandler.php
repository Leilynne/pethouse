<?php

declare(strict_types=1);

namespace App\Handlers\User\UserGetCollection;

use App\Mappers\UserMapper;
use App\Repositories\UserRepositoryInterface;

readonly class GetAllUsersHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){
    }


    public function handle(UserGetCollectionCommand $command): UserGetCollectionResponse
    {
        $filters = [
            'name' => $command->name,
        ];
        $paginator = $this->userRepository->getAllUsers($command->page, $filters);

        return new UserGetCollectionResponse(
            UserMapper::mapModelsToDTOArray($paginator->items()),
            $paginator->total(),
            $paginator->lastPage(),
        );
    }

}
