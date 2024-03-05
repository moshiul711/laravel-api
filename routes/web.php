<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\Post\PostController;
use App\Http\Controllers\WebsiteController;
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




Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/',[WebsiteController::class,'index'])->name('home');
    Route::get('/post/like/{id}',[WebsiteController::class,'like'])->name('post.like');
    Route::post('/post/comment/{id}',[WebsiteController::class,'comment'])->name('post.comment');
    Route::resource('post',PostController::class);
});
