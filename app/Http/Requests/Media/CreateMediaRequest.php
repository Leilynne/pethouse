<?php

namespace App\Http\Requests\Media;


use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateMediaRequest extends FormRequest
{
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
}
