<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Handlers\Auth\UserLoginHandler;
use App\Handlers\Auth\UserRegisterHandler;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\UserLogoutHandler;
use App\Http\Resources\SuccessfulResponseResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UnsuccessfulResponseResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

readonly class AuthController
{
    public function __construct(
        private UserLoginHandler $userLoginHandler,
        private UserRegisterHandler $userRegisterHandler,
        private UserLogoutHandler $userLogoutHandler,
    ){
    }

    public function register(CreateUserRequest $request): TokenResource
    {
        $data =  $request->validated();

        return new TokenResource($this->userRegisterHandler->handle($data));

    }

    public function login(LoginUserRequest $request): TokenResource|UnsuccessfulResponseResource
    {
        $data = $request->validated();
        try {
            $resource = new TokenResource($this->userLoginHandler->handle($data));
        } catch (InvalidCredentialsException) {
            $resource = (new UnsuccessfulResponseResource('Invalid credentials')); // TODO error
        }

        return $resource;
    }

    public function logout(): SuccessfulResponseResource
    {
        $user = Auth::user();
        $this->userLogoutHandler->handle($user);

        return new SuccessfulResponseResource('Successfully logged out');
    }
}
