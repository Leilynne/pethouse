<?php

declare(strict_types=1);

namespace App\Handlers\Animal\AnimalGetCollection;

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Mappers\AnimalMapper;
use App\Repositories\AnimalRepositoryInterface;
use Carbon\CarbonImmutable;

readonly class AnimalGetAllHandler
{
    public function __construct(
        private AnimalRepositoryInterface $animalRepository
    ) {
    }

    public function handle(AnimalGetCollectionCommand $command): AnimalGetCollectionResponse
    {
        $status = null;

        if ($command->userRole !== UserRole::Admin && $command->status === null) {
            $status = [AnimalStatus::LookingHome, AnimalStatus::Awaiting];
        } elseif ($command->status !== null) {
            $status = [$command->status];
        }

        if (isset($command->age)) {
            $now = (new CarbonImmutable())->setTime(0, 0);

            if (null !== $command->age->getFromModifyString()) {
                $birthdayAfter = $now->modify($command->age->getFromModifyString());
            }

            if (null !== $command->age->getToModifyString()) {
                $birthdayBefore = $now->modify($command->age->getToModifyString());
            }
        }

        $filters = [
            'color' => $command->colorId,
            'type' => $command->type,
            'sex' => $command->sex,
            'health' => $command->health,
            'status' => $status,
            'tags' => $command->tags,
            'birthdayBefore' => $birthdayBefore ?? null,
            'birthdayAfter' => $birthdayAfter ?? null,
        ];
        $paginator = $this->animalRepository->getAllAnimals($command->page, $filters);

        return new AnimalGetCollectionResponse(
            AnimalMapper::mapModelsToDTOArray($paginator->items()),
            $paginator->total(),
            $paginator->lastPage(),
        );
    }
}
