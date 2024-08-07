<?php

declare(strict_types=1);

namespace App\Rules;

use App\Enums\MediaEntityType;
use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\PostNotFoundException;
use App\Repositories\AnimalRepository;
use App\Repositories\PostRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class MediaEntityExists implements ValidationRule
{
    private ?string $entityType;

    public function __construct(
        private AnimalRepository $animalRepository,
        private PostRepository $postRepository,
    ) {
    }

    public function setEntityType(?string $entityType): self
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            match ($this->entityType) {
                MediaEntityType::Animal->value => $this->animalRepository->getAnimalById((int) $value),
                MediaEntityType::Post->value => $this->postRepository->getPostById((int) $value),
                default => $fail("Media entity doesn't exist."),
            };
        } catch (AnimalNotFoundException|PostNotFoundException) {
            $fail("Entity with id $value and type $this->entityType doesn't exist.");
        }
    }
}
