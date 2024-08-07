<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\AdoptionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AdoptionRequest
 */
class AdminAdoptionResource extends JsonResource
{
    public function __construct(AdoptionRequest $resource)
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
            'user_id' => $this->user_id,
            'animal_id' => $this->animal_id,
            'status' => $this->status,
        ];
    }
}
