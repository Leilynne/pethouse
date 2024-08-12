<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\MediaDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MediaDTO
 */
class MediaResource extends JsonResource
{
    public function __construct(MediaDTO $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file_name' => $this->fileName,
            'primary' => $this->primary,
        ];
    }
}
