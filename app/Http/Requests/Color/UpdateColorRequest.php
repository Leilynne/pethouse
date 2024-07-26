<?php

declare(strict_types=1);

namespace App\Http\Requests\Color;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateColorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:15', 'min:1', 'unique:colors,name'],
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
