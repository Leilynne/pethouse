<?php

declare(strict_types=1);

namespace App\Http\Requests\Color;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateColorRequest extends FormRequest
{    /**
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
}
