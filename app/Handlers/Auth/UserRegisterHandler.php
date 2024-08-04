<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class UserRegisterHandler
{

    public function handle(array $data):string
    {
        $user = User::create([
            'role' => UserRole::User,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);

        return $user->createToken('api-token', ['user'])->plainTextToken;
    }

}
