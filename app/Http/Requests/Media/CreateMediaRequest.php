<?php

namespace App\Http\Requests\Media;


use App\Enums\MediaEntityType;
use App\Rules\MediaEntityExists;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreateMediaRequest extends FormRequest
{
    public function __construct(
        readonly private MediaEntityExists $mediaEntityExists,
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
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
            'entity_id' => [
                'required',
                $this->mediaEntityExists->setEntityType(
                    $this->input('entity_type')
                )
            ],
            'entity_type' => ['required', Rule::enum(MediaEntityType::class)]
        ];
    }
}
