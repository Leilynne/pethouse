<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use App\Enums\UserRole;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class UserLoginHandler
{

    /**
     * @throws InvalidCredentialsException
     */
    public function handle(array $data): string
    {
        /** @var User $user */
        $user = User::where('email', $data['email'])->first();

        if (null === $user || false === Hash::check($data['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }

        if (UserRole::Admin === $user->role) {
            $abilities = ['user', 'admin'];
        } else {
            $abilities = ['user'];
        }

        return $user->createToken('api-token', $abilities)->plainTextToken;
    }

}
