<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Handlers\Post\DeletePostHandler;
use App\Handlers\Post\GetAllPostsHandler;
use App\Handlers\Post\GetPostByIdHandler;
use App\Handlers\Post\PostCreate\CreatePostHandler;
use App\Handlers\Post\PostCreate\PostCreateCommand;
use App\Handlers\Post\PostUpdate\PostUpdateCommand;
use App\Handlers\Post\PostUpdate\UpdatePostHandler;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\SuccessfulResponseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class PostController
{

    public function __construct(
        private GetAllPostsHandler $getAllPostsHandler,
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
        $post = $this->createPostHandler->handle(
            new PostCreateCommand(
                $data['title'],
                $data['description'],
                $data['preview'],
            )
        );

        return new PostResource($post);
    }

    public function update(int $postId, UpdatePostRequest $updatePostRequest): PostResource
    {
        $data = $updatePostRequest->validated();
        $post = $this->updatePostHandler->handle(
            new PostUpdateCommand(
                $postId,
                $data['title'],
                $data['description'],
                $data['preview'] ?? null,
            )
        );

        return new PostResource($post);
    }

    public function destroy(int $postId): SuccessfulResponseResource
    {
        $this->deletePostHandler->handle($postId);

        return new SuccessfulResponseResource('Post deleted');
    }

}
