<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ArticleController;

Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('profile', [AuthController::class, 'profile'])->name('profile');

        Route::middleware('check.permission:view-all-users')->group(function () {
            Route::post('users/role/update', [UserController::class, 'updateRole'])->name('users.updateRole')->middleware('check.permission:assign-roles');
            Route::apiResource('users', UserController::class);
        });

        Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/own', [ArticleController::class, 'ownArticle'])->name('articles.ownArticle')->middleware('check.permission:view-own-articles');
        Route::get('/articles/publish/{id}', [ArticleController::class, 'publish'])->name('articles.publish')->middleware('check.permission:publish-article');

        Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store')->middleware('check.permission:create-article');

        Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show')->middleware('check.permission:assign-roles');

        Route::put('/articles/update/{id}', [ArticleController::class, 'update'])->name('articles.update')->middleware('check.permission:edit-own-article');

        Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('check.permission:delete-articles');
    });
});
