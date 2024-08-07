<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\Repositories\AdoptionRequestRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class UserGetAdoptionRequestHandler
{
    public function __construct(
        private AdoptionRequestRepository $adoptionRequestRepository,
    ){
    }

    public function handle(int $userId): Collection
    {
        return $this->adoptionRequestRepository->getAdoptionRequestsByUserId($userId);
    }
}
