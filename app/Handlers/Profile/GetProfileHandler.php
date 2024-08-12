<?php

declare(strict_types = 1);

namespace App\Handlers\Profile;

use App\DTO\UserDTO;
use App\Mappers\UserMapper;
use Illuminate\Support\Facades\Auth;

readonly class GetProfileHandler
{
    public function handle(): UserDTO
    {
        return UserMapper::mapModelToDTO(Auth::user());
    }

}
