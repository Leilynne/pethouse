<?php

declare(strict_types=1);

namespace App\Rules;

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use ValueError;

readonly class AnimalStatusRule implements ValidationRule
{
    public function __construct(
        private ?UserRole $userRole,
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $status = AnimalStatus::from($value);
        } catch (ValueError) {
            $fail('Animal status is not valid.');

            return;
        }

        if (
            $this->userRole !== UserRole::Admin
            && false === in_array($status, [AnimalStatus::Awaiting, AnimalStatus::LookingHome])
        ) {
            $fail('Animal status is not valid.');
        }
    }
}
