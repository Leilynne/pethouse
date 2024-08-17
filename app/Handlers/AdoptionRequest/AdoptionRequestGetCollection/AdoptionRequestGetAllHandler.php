<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest\AdoptionRequestGetCollection;

use App\Mappers\AdoptionRequestMapper;
use App\Repositories\AdoptionRequestRepositoryInterface;

readonly class AdoptionRequestGetAllHandler
{

    public function __construct(
        private AdoptionRequestRepositoryInterface $adoptionRequestRepository,
    ){
    }

    /**
     * @param AdoptionRequestGetCollectionCommand $command
     * @return AdoptionRequestGetCollectionResponse
     */
    public function handle(AdoptionRequestGetCollectionCommand $command): AdoptionRequestGetCollectionResponse
    {
        $filters = [
            'status' => $command->status,
        ];

        $paginator = $this->adoptionRequestRepository->getAllAdoptionRequests($command->page, $filters, ['animal', 'user']);

        return new AdoptionRequestGetCollectionResponse(
            AdoptionRequestMapper::mapModelsToDTOArray($paginator->items()),
            $paginator->total(),
            $paginator->lastPage(),
        );
    }
}
