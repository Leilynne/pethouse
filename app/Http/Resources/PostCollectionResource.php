<?php

namespace App\Http\Resources;

use App\Handlers\Post\PostGetCollectionResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollectionResource extends ResourceCollection
{
    private int $total;
    private int $lastPage;
    private int $currentPage;

    public function __construct(PostGetCollectionResponse $resource)
    {
        $this->total = $resource->total;
        $this->lastPage = $resource->lastPage;
        $this->currentPage = $resource->currentPage;

        parent::__construct($resource->post);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => PostResource::collection($this->resource),
            'pagination' => [
                'total' => $this->total,
                'lastPage' => $this->lastPage,
                'currentPage' => $this->currentPage,
            ],
        ];
    }
}
