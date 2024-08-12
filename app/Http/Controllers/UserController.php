<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Handlers\User\GetAllUsersHandler;
use App\Handlers\User\UserShowHandler;
use App\Handlers\User\UserUpdate\UserUpdateByAdminCommand;
use App\Handlers\User\UserUpdate\UserUpdateHandler;
use App\Http\Requests\User\UpdateUserByAdminRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class UserController
{
    public function __construct(
        private UserShowHandler $getUserByIdHandler,
        private UserUpdateHandler $userUpdateHandler,
        private GetAllUsersHandler $getAllUsersHandler,
    ){
    }

    public function getUserById(int $userId): UserResource
    {
        return new UserResource($this->getUserByIdHandler->handle($userId));
    }

    public function updateUser(UpdateUserByAdminRequest $request, int $userId): UserResource
    {
        $data = $request->validated();
        return new UserResource($this->userUpdateHandler->handle(
            new UserUpdateByAdminCommand(
                $userId,
                $data['name'],
                $data['email'],
                $data['phone'],
                $data['text'],
            )
        ));
    }

    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection($this->getAllUsersHandler->handle());
    }

}
