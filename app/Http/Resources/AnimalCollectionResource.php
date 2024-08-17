<?php

namespace App\Http\Resources;

use App\Handlers\Animal\AnimalGetCollection\AnimalGetCollectionResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnimalCollectionResource extends ResourceCollection
{
    private int $total;
    private int $lastPage;

    public function __construct(AnimalGetCollectionResponse $resource)
    {
        $this->total = $resource->total;
        $this->lastPage = $resource->lastPage;

        parent::__construct($resource->animals);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => AnimalResource::collection($this->resource),
            'pagination' => [
                'total' => $this->total,
                'lastPage' => $this->lastPage,
            ],
        ];
    }
}
