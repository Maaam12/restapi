<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/posts/{id}', [PostController::class, 'update'])->middleware('pemilik-postingan');
});


Route::post('/login', [AuthController::class, 'login']);
