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
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
//        $this->app->bind(AnimalRepositoryInterface::class, AnimalRepository::class);
//        $this->app->bind(ColorRepositoryInterface::class, ColorRepository::class);
//        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
//        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
//        $this->app->bind(AdoptionRequestRepositoryInterface::class, AdoptionRequestRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
