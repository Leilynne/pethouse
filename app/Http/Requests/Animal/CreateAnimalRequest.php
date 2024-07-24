<?php

namespace App\Http\Requests\Animal;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class CreateAnimalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'birthday' => ['date'],
            'sex' => ['required', Rule::enum(AnimalSex::class)],
            'type' => ['required', Rule::enum(AnimalType::class)],
            'health' => ['required', Rule::enum(AnimalHealth::class)],
            'animal_status' => ['required', Rule::enum(AnimalStatus::class)],
            'color_id' => ['required', 'exists:colors,id'],
            'user_id' => ['exists:users,id'],
            'comment' => ['string', 'max:255', 'min:1'],
            'description' => ['required', 'string', 'max:1000', 'min:1'],
            'preview' => ['required', File::types(['jpg', 'jpeg', 'png'])->max('2mb')],
        ];
    }

    /**
     * Customize the response returned when validation fails.
     *
     * @param Validator $validator
     * @return JsonResponse
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        throw new ValidationException(
            $validator,
            response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
