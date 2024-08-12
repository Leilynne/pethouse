<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\ColorDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ColorDTO
 */
class ColorResource extends JsonResource
{
    public function __construct(ColorDTO $resource)
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
            'name' => $this->name,
        ];
    }
}
