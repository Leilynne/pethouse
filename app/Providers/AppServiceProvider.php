<?php

namespace App\Providers;

use App\Repositories\AdoptionRequestRepository;
use App\Repositories\AdoptionRequestRepositoryInterface;
use App\Repositories\AnimalRepository;
use App\Repositories\AnimalRepositoryInterface;
use App\Repositories\ColorRepository;
use App\Repositories\ColorRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AnimalRepositoryInterface::class => AnimalRepository::class,
        ColorRepositoryInterface::class => ColorRepository::class,
        TagRepositoryInterface::class => TagRepository::class,
        PostRepositoryInterface::class => PostRepository::class,
        AdoptionRequestRepositoryInterface::class => AdoptionRequestRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
