<?php

declare(strict_types=1);

namespace App\Http\Controllers\TagController;


use App\Handlers\Tags\TagCreateHandler;
use App\Handlers\Tags\TagDeleteHandler;
use App\Handlers\Tags\TagGetAllHandler;
use App\Handlers\Tags\TagShowHandler;
use App\Handlers\Tags\TagUpdateHandler;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\SuccessfulResponseResource;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class TagController
{
    public function __construct(
        private TagGetAllHandler $tagGetAllHandler,
        private TagCreateHandler  $tagCreateHandler,
        private TagShowHandler $tagShowHandler,
        private TagUpdateHandler $tagUpdateHandler,
        private TagDeleteHandler $tagDeleteHandler
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $tags = $this->tagGetAllHandler->handle();

        return TagResource::collection($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request): TagResource
    {
        $tag = $this->tagCreateHandler->handle($request->validated());

        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $tagId): TagResource
    {
        $tag = $this->tagShowHandler->handle($tagId);

        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, int $tagId): TagResource
    {
        $tag = $this->tagUpdateHandler->handle($request->validated(), $tagId);

        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tagId):SuccessfulResponseResource
    {
        $this->tagDeleteHandler->handle($tagId);

        return new SuccessfulResponseResource("Tag $tagId deleted successfully");
    }
}
