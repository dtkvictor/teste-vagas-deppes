<?php

use App\Http\Controllers\AuthController,
    App\Http\Controllers\BookController,
    App\Http\Controllers\BookcaseController,
    App\Http\Controllers\CategoryController,
    App\Http\Controllers\PublisherController,
    App\Http\Controllers\UserController;

use App\Http\Middleware\UnauthMiddleware;
use Illuminate\Support\Facades\Route;

use Laravel\Sanctum\Http\Controllers\CsrfCookieController;


Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::post('auth/login', [AuthController::class, 'login'])->middleware(UnauthMiddleware::class);
Route::post('auth/register', [AuthController::class, 'register'])->middleware(UnauthMiddleware::class);

Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('publishers', PublisherController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function() 
{
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    
    Route::get('user/me', [UserController::class, 'me']);
    Route::match(['put', 'patch'], 'user/update', [UserController::class, 'update']);
    Route::match(['put', 'patch'], 'user/update/password', [UserController::class, 'updatePassword']);
    Route::delete('user/delete', [UserController::class, 'delete']);
    
    Route::apiResource('bookcase', BookcaseController::class)->only(['index', 'show']);
    Route::post('bookcase/create', [BookController::class, 'create']);
    Route::post('bookcase/update/{id}', [BookController::class, 'update'])->where('id', '[0-9]+');
    Route::post('bookcase/delete/{id}', [BookController::class, 'delete'])->where('id', '[0-9]+');

    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('publishers', PublisherController::class)->except(['index', 'show']);    
});