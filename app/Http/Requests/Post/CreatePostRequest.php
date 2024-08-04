<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'animal_id' => ['exists:App/Models/Animal,id'],
            'text' => ['string', 'min:3', 'max:1000'],
        ];
    }
}
