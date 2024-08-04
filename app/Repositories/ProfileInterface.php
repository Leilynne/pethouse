<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ProfileInterface
{


    /**
     * @param int $userId
     * @return User
     */
    public function getMyProfile(int $userId):User;

    /**
     * @param int $userId
     * @return Collection
     */
    public function getAllMyAnimals(int $userId):Collection;

}
