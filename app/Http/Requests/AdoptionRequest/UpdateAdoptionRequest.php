<?php

namespace App\Http\Requests\AdoptionRequest;

use App\Enums\AdoptionStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdoptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'animal_id' => ['exists:App/Models/Animal,id'],
            'user_id' => ['exists:App/Models/User,id'],
            'status' => [Rule::enum(AdoptionStatus::class)],
        ];
    }
}
