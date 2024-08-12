<?php

declare(strict_types=1);

namespace App\Handlers\Post\PostCreate;

use Illuminate\Http\UploadedFile;

readonly class PostCreateCommand
{
    public function __construct(
        public string $title,
        public string $description,
        public UploadedFile $file,
    ) {
    }
}
