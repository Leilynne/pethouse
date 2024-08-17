<?php

namespace App\Http\Requests\Animal;

use App\Enums\AnimalAge;
use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalType;
use App\Rules\AnimalStatusRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimalPaginatorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => ['int', 'min:1'],
            'color' => ['int', 'exists:colors,id'],
            'type' => [Rule::enum(AnimalType::class)],
            'sex' => [Rule::enum(AnimalSex::class)],
            'health' => [Rule::enum(AnimalHealth::class)],
            'status' => [new AnimalStatusRule($this->user()?->role)],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
            'age' => [Rule::enum(AnimalAge::class)],
        ];
    }
}
