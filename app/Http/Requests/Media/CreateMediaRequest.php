<?php

namespace App\Http\Requests\Media;


use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class CreateMediaRequest extends FormRequest
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
            'photo' => ['required', File::types(['jpg', 'jpeg', 'png'])->max('2mb')],
            'animal_id' => ['required', 'exists:animals,id'],
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
