<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

Route::get('top', [PostsController::class, 'index'])
    ->name('top');

Route::post('posts', [PostsController::class, 'store'])
    ->name('posts.store');

Route::put('posts/{post}', [PostsController::class, 'update'])
    ->name('posts.update');

Route::delete('posts/{post}', [PostsController::class, 'destroy'])
    ->name('posts.destroy');

Route::get('profile', [ProfileController::class,'profile'])
    ->name('profile');

Route::get('profile/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit');

Route::post('profile/edit', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::get('profile/{id}', [ProfileController::class, 'show'])
    ->name('profile.show');

Route::get('search', [UsersController::class, 'search'])
    ->name('search');

Route::get('follow-list', [FollowsController::class, 'followList'])
    ->name('follow-list');

Route::get('follower-list', [FollowsController::class, 'followerList'])
    ->name('follower-list');

Route::post('follow/{id}', [FollowsController::class, 'follow'])
    ->name('follow');

Route::post('unfollow/{id}', [FollowsController::class, 'unfollow'])
    ->name('unfollow');

});
