<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\PostDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PostDTO
 */
class PostResource extends JsonResource
{

    public function __construct(PostDTO $resource)
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
           'description' => $this->description,
           'title' => $this->title,
           'preview' => new MediaResource($this->preview),
           'photos' => MediaResource::collection($this->photos),
       ];
   }
}
