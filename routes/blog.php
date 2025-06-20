<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Post;
use Illuminate\Support\Facades\Http;

// 📌 Groupe de routes blog
Route::prefix('blog')->name('blog.')->group(function () {

    // 🏠 Accueil du blog avec statistiques aléatoires
    Route::get('/', function () {
        $posts = Post::latest()->get();

        $stats = [
            "1 femme sur 10 est atteinte d’endométriose dans le monde.",
            "Le délai moyen de diagnostic est de 7 ans.",
            "30 à 40 % des femmes atteintes d’endométriose ont des difficultés à concevoir.",
            "Environ 2 millions de femmes en France seraient concernées.",
            "Plus de 190 millions de personnes vivent avec l’endométriose (source OMS)."
        ];

        $stat = $stats[array_rand($stats)];

        return view('index', compact('posts', 'stats'));
    })->name('index');

    // // 🔍 Recherche
    // Route::get('/search', [SearchController::class, 'search'])->name('search');

    // 📝 CRUD des articles (sans show, qui a une URL custom)
    Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
        Route::resource('articles', PostController::class)->except(['show']);
        Route::post('/articles', [PostController::class, 'store'])->name('blog.articles.store');
    });

    // 🧠 Vue mixte : Articles Wikipédia + Articles créés
    Route::get('/article', function () {
        $customPosts = \App\Models\Post::latest()->get();
        return view('blog.articles.article', compact('customPosts'));
    })->name('article');

    // 📄 Affichage d’un article
    Route::get('/article/{slug}', [PostController::class, 'show'])->name('posts.show');
});
