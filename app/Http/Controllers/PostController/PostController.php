<?php

declare(strict_types=1);

namespace App\Http\Controllers\PostController;

use App\Handlers\Post\CreatePostHandler;
use App\Handlers\Post\DeletePostHandler;
use App\Handlers\Post\GetAllPostsHandler;
use App\Handlers\Post\GetPostByIdHandler;
use App\Handlers\Post\UpdatePostHandler;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\SuccessfulResponseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class PostController
{

    public function __construct(
        private GetAllPostsHandler  $getAllPostsHandler,
        private GetPostByIdHandler $getPostByIdHandler,
        private CreatePostHandler $createPostHandler,
        private UpdatePostHandler $updatePostHandler,
        private DeletePostHandler $deletePostHandler
    ){
    }

    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection($this->getAllPostsHandler->handle());

    }

    public function show(int $postId): PostResource
    {
        return new PostResource($this->getPostByIdHandler->handle($postId));
    }

    public function store(CreatePostRequest $createPostRequest): PostResource
    {
        $data = $createPostRequest->validated();

        return new PostResource($this->createPostHandler->handle($data));
    }

    public function update(int $postId, UpdatePostRequest $updatePostRequest): PostResource
    {
        $data = $updatePostRequest->validated();
        $post = $this->updatePostHandler->handle($postId, $data);

        return new PostResource($post);
    }

    public function destroy(int $postId): SuccessfulResponseResource
    {
        $this->deletePostHandler->handle($postId);

        return new SuccessfulResponseResource('Post deleted');
    }

}
