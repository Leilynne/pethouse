<?php

declare(strict_types = 1);

namespace App\Handlers\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

readonly class GetProfileHandler
{
    public function handle(): User
    {
        return Auth::user();
    }

}
