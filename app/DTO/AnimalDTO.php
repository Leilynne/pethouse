<?php

namespace App\DTO;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use Illuminate\Support\Carbon;

class AnimalDTO
{
    /**
     * @param int $id
     * @param string $name
     * @param AnimalType $type
     * @param AnimalHealth $health
     * @param string $description
     * @param AnimalStatus $status
     * @param AnimalSex $sex
     * @param ColorDTO $color
     * @param Carbon|null $birthday
     * @param MediaDTO $preview
     * @param TagDTO[] $tags
     * @param MediaDTO[] $photos
     * @param UserDTO|null $user
     * @param UserDTO[] $curators
     * @param string|null $comment
     */
    public function __construct(
        public int                $id,
        public string             $name,
        public AnimalType         $type,
        public AnimalHealth       $health,
        public string             $description,
        public AnimalStatus       $status,
        public AnimalSex          $sex,
        public ColorDTO           $color,
        public ?Carbon            $birthday,
        public MediaDTO           $preview,
        public array              $tags,
        public array              $photos,
        public ?UserDTO           $user,
        public array              $curators,
        public ?string            $comment = null,
    ) {
    }
}
