<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});
