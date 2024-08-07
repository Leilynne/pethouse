<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required','string', 'min:3', 'max:1000'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'preview' => ['required', File::types(['jpg', 'jpeg', 'png'])->max('2mb')],
        ];
    }
}
