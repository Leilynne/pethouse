<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{

    public function __construct(Post $resource)
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
           'preview' => new MediaResource($this->preview),
           'photos' => MediaResource::collection($this->photos),
       ];
   }
}
