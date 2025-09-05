<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ArticleController;

//  Routes pour les articles du blog

Route::prefix('blog')->group(function () {

    //  Route pour l'article statique (extrait Wikipédia)
    Route::get('/article', [ArticleController::class, 'wikipedia'])->name('blog.article');

    //  Liste des articles
    Route::get('/{slug}--{id}', [ArticleController::class, 'show'])
        ->where('slug', '.*')
        ->where('id', '[0-9]+')
        ->name('posts.show');
});
