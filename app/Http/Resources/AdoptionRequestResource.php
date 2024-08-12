<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\AdoptionRequestDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AdoptionRequestDTO
 */
class AdoptionRequestResource extends JsonResource
{
    public function __construct(AdoptionRequestDTO $resource)
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
            'user' => new UserResource($this->user),
            'animal' => new AnimalResource($this->animal),
            'status' => $this->status,
        ];
    }
}
