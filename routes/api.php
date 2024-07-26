<?php

use App\Http\Controllers\AnimalController\AnimalController;
use App\Http\Controllers\ColorController\ColorController;
use App\Http\Controllers\TagController\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('/animals', AnimalController::class)->except(['create', 'edit']);
Route::resource('/colors', ColorController::class)->except(['create', 'edit']);
Route::resource('/tags', TagController::class)->except(['create', 'edit']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
