<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\DTO\AdoptionRequestDTO;
use App\Enums\AdoptionStatus;
use App\Mappers\AdoptionRequestMapper;
use App\Repositories\AdoptionRequestRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

readonly class UserCancelAdoptionRequestHandler
{
    public function __construct(
        private AdoptionRequestRepositoryInterface $repository,
    ){
    }

    public function handle(int $adoptionId): AdoptionRequestDTO
    {
        $adoptionRequest = $this->repository->getAdoptionRequestById($adoptionId);
        if (Auth::id() !== $adoptionRequest->user_id) {
             throw new AccessDeniedHttpException('User cannot cancel adoption request that does not belongs to him.');
        }
        $adoptionRequest->status = AdoptionStatus::Cancelled;
        $adoptionRequest->save();

        return AdoptionRequestMapper::mapModelToDTO($adoptionRequest);
    }
}
