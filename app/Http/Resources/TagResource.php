<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\TagDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin TagDTO
 */
class TagResource extends JsonResource
{
    public function __construct(TagDTO $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return TagDTO[]
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
