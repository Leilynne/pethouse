<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserController;

use App\Handlers\User\UserShowHandler;
use App\Handlers\User\UserUpdateHandler;
use App\Http\Requests\User\UpdateUserByAdminRequest;
use App\Http\Resources\Admin\UserAdminResource;
use App\Http\Resources\UserResource;

readonly class UserController
{
    public function __construct(
        private UserShowHandler $getUserByIdHandler,
        private UserUpdateHandler $userUpdateHandler,
    ){
    }

    public function getUserById(int $userId): UserResource
    {
        return new UserResource($this->getUserByIdHandler->handle($userId));
    }

    public function updateUser(UpdateUserByAdminRequest $request, int $userId): UserAdminResource
    {
        $data = $request->validated();
        return new UserAdminResource($this->userUpdateHandler->handle($data, $userId));
    }

}
