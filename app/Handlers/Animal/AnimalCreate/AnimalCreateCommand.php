<?php

namespace App\Handlers\Animal\AnimalCreate;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

readonly class AnimalCreateCommand
{
    /**
     * @param string $name
     * @param Carbon|null $birthday
     * @param AnimalSex $sex
     * @param AnimalType $type
     * @param AnimalHealth $health
     * @param AnimalStatus $status
     * @param int $colorId
     * @param int|null $userId
     * @param string|null $comment
     * @param string $description
     * @param UploadedFile $preview
     * @param int[] $tags
     */
    public function __construct(
        public string $name,
        public ?Carbon $birthday,
        public AnimalSex $sex,
        public AnimalType $type,
        public AnimalHealth $health,
        public AnimalStatus $status,
        public int $colorId,
        public ?int $userId,
        public ?string $comment,
        public string $description,
        public UploadedFile $preview,
        public array $tags,
    ) {
    }
}
