<?php

namespace App\Http\Requests\AdoptionRequest;

use App\Enums\AdoptionStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdoptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'animal_id' => ['exists:animals,id'],
            'user_id' => ['exists:users,id'],
            'status' => [Rule::enum(AdoptionStatus::class)],
        ];
    }
}
