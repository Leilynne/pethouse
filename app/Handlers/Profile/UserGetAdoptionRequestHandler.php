<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\DTO\AdoptionRequestDTO;
use App\Mappers\AdoptionRequestMapper;
use App\Repositories\AdoptionRequestRepositoryInterface;

readonly class UserGetAdoptionRequestHandler
{
    public function __construct(
        private AdoptionRequestRepositoryInterface $adoptionRequestRepository,
    ){
    }

    /**
     * @param int $userId
     * @return AdoptionRequestDTO[]
     */
    public function handle(int $userId): array
    {
        return AdoptionRequestMapper::mapModelsToDTOArray($this->adoptionRequestRepository->getAdoptionRequestsByUserId($userId));
    }
}
