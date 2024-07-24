<?php

namespace App\Http\Requests\Animal;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnimalRequest extends FormRequest
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
            'name' => ['required', 'string' , 'max:100', 'min:1'],
            'birthday' => ['date'],
            'sex' => ['required', Rule::enum(AnimalSex::class)],
            'type' => ['required', Rule::enum(AnimalType::class)],
            'health' => ['required', Rule::enum(AnimalHealth::class)],
            'animal_status' => ['required', Rule::enum(AnimalStatus::class)],
            'color_id' => ['exists:App/Models/Color,id'],
            'user_id' => ['exists:App/Models/User,id'],
            'comment' => ['string', 'max:255', 'min:1'],
        ];
    }
}
