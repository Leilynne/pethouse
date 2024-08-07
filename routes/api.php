<?php

use App\Http\Controllers\AdoptionRequestController\AdoptionRequestController;
use App\Http\Controllers\AnimalController\AnimalController;
use App\Http\Controllers\ColorController\ColorController;
use App\Http\Controllers\MediaController\MediaController;
use App\Http\Controllers\PostController\PostController;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\TagController\TagController;
use App\Http\Controllers\UserController\UserController;
use App\Http\Middleware\Guest;
use App\Http\Middleware\OptionalAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/**
 * Guest only actions
 */
Route::middleware(Guest::class)->group(static function (): void {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

/**
 * Anybody can do it
 */
Route::middleware(OptionalAuth::class)->group(static function (): void {
    Route::controller(AnimalController::class)->group(static function (): void {
        Route::get('/animals', 'index');
        Route::get('/animals/{animal}', 'show');
    });

    Route::controller(ColorController::class)->group(static function (): void {
        Route::get('/colors', 'index');
    });

    Route::controller(TagController::class)->group(static function (): void {
        Route::get('/tags', 'index');
    });

    Route::controller(PostController::class)->group(static function (): void {
        Route::get('/posts', 'index');
        Route::get('/posts/{post}', 'show');
    });
});

/**
 * Auth user only actions
 */
Route::middleware('auth:sanctum')->group(static function (): void {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(AnimalController::class)->group(static function (): void {
        Route::post('/animals', 'store')->middleware('abilities:admin');
        Route::put('/animals/{animal}', 'update')->middleware('abilities:admin');
        Route::delete('/animals/{animal}', 'destroy')->middleware('abilities:admin');
        Route::post('/animals/{animal}/curator', 'addCurator')->middleware('abilities:user');
        Route::delete('/animals/{animal}/curator', 'deleteCurator')->middleware('abilities:user');
    });

    Route::controller(ColorController::class)->group(static function () {
        Route::get('/colors/{color}', 'show');
        Route::post('/colors', 'store');
        Route::put('/colors/{color}', 'update');
        Route::delete('/colors/{color}', 'destroy');
    })->middleware('abilities:admin');

    Route::controller(PostController::class)->group(static function (): void {
        Route::post('/posts', 'store');
        Route::put('/posts/{post}', 'update');
        Route::delete('/posts/{post}', 'destroy');
    })->middleware('abilities:admin');

    Route::middleware('abilities:admin')
        ->resource('/tags', TagController::class)
        ->except('edit', 'create', 'index');

    Route::middleware('abilities:admin')
        ->resource('/media', MediaController::class)
        ->only(['store', 'destroy']);

    Route::controller(ProfileController::class)
        ->group(static function (): void {
            Route::get('/profile', 'show');
            Route::get('/profile/get-animals', 'getAllMyAnimals');
            Route::put('/profile', 'update');
            Route::post('/profile/create-animal', 'createMyAnimal');
            Route::put('/profile/update-animal/{animal}', 'updateMyAnimal');
            Route::get('/profile/get-supervised-animals', 'getAllMySupervisedAnimals');
            Route::get('/profile/get-adoption-requests', 'getUserAdoptionRequest');
            Route::put('/profile/cancel-request/{adoption}', 'update');
    });


    Route::controller(AdoptionRequestController::class)->group(static function () {
        Route::get('/adoption-requests', 'index')->middleware('abilities:admin');
        Route::get('/adoption-requests/{adoptionRequest}', 'show')->middleware('abilities:admin');
        Route::post('/adoption-requests', 'store');
        Route::put('/adoption-requests/{adoptionRequest}', 'update')->middleware('abilities:admin');
    });

    Route::controller(UserController::class)
        ->group(static function (): void {
            Route::get('/users/{user}', 'getUserById');
            Route::put('/users/{user}', 'updateUser');
        })->middleware('abilities:admin');
});

