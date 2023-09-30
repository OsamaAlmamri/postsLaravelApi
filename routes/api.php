<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostsController::class, 'index']);
Route::get('posts/{id}', [PostsController::class, 'show']);
Route::get('tags', [TagsController::class, 'index']);
Route::middleware('auth:sanctum')->group(callback: function () {
    Route::post('posts', [PostsController::class, 'store']);
    Route::put('posts/{id}', [PostsController::class, 'update']);
    Route::delete('posts/{id}', [PostsController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
