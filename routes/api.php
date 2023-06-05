<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\JobCategoryController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\TestController;


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
Route::get('profiles', [ProfileController::class, 'index']);
Route::post('profiles/create', [ProfileController::class, 'store']);
Route::get('profiles/show/{id}', [ProfileController::class, 'show']);
Route::post('profiles/update/{id}', [ProfileController::class, 'update']);
Route::delete('profiles/destroy/{id}', [ProfileController::class, 'destroy']);

// Test MBTI
Route::get('tests', [TestController::class, 'index']);
Route::post('tests/create', [TestController::class, 'store']);
Route::get('tests/show/{id}', [TestController::class, 'show']);
Route::put('tests/update/{id}', [TestController::class, 'update']);
Route::delete('tests/destroy/{id}', [TestController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
