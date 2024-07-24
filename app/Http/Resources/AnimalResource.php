<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Animal
 */
class AnimalResource extends JsonResource
{
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
            'type' => $this->type,
            'health' => $this->health,
            'description' => $this->description,
            'animal_status' => $this->animal_status,
            'sex'=> $this->sex,
            'color' => new ColorResource($this->color),
            'birthday' => $this->birthday,
            'preview' => $this->preview?->file_name,
            'tags' => TagResource::collection($this->tags),
            'photos' => $this->photos->pluck('file_name')->toArray(),
        ];
    }
}
