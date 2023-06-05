<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\JobCategoryController;
use App\Http\Controllers\API\ProfileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//CRUD
Route::get('mahasiswa',[MahasiswaController::class, 'index']);
Route::post('mahasiswa/store',[MahasiswaController::class, 'store']);
Route::get('mahasiswa/show/{id}',[MahasiswaController::class, 'show']);
Route::post('mahasiswa/update/{id}',[MahasiswaController::class, 'update']);
Route::get('mahasiswa/destroy/{id}',[MahasiswaController::class, 'destroy']);

// Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('protected-resource', [AuthController::class, 'protectedResource']);

// Job Category
Route::get('job-categories', [JobCategoryController::class, 'index']);
Route::post('job-categories/store', [JobCategoryController::class, 'store']);
Route::get('job-categories/show/{id}', [JobCategoryController::class, 'show']);
Route::post('job-categories/update/{id}', [JobCategoryController::class, 'update']);
Route::delete('job-categories/destroy/{id}', [JobCategoryController::class, 'destroy']);

// Profile Page
Route::prefix('profile')->group(function () {
    Route::post('profile/create', [ProfileController::class, 'create']);
    Route::get('profile/show/{id}', [ProfileController::class, 'show']);
    Route::put('profile/update/{id}', [ProfileController::class, 'update']);
    Route::delete('profile/delete/{id}', [ProfileController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
