<?php

namespace App\Handlers\Animal\AnimalGetCollection;

use App\Enums\AnimalAge;
use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use App\Enums\UserRole;

readonly class AnimalGetCollectionCommand
{
    public function __construct(
        public int $page,
        public ?int $colorId,
        public ?AnimalType $type,
        public ?AnimalSex $sex,
        public ?AnimalHealth $health,
        public ?UserRole $userRole,
        public ?AnimalStatus $status,
        public array $tags,
        public ?AnimalAge $age,
    ) {
    }
}
