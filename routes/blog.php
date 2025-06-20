<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Post;
use Illuminate\Support\Facades\Http;

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

    // 🔍 Recherche (à activer si besoin)
    // Route::get('/search', [SearchController::class, 'search'])->name('search');

    // 📝 CRUD des articles - SAUF show qui est personnalisé
    Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
        Route::resource('articles', PostController::class)
            ->names('posts')
            ->except(['show']); // Exclure show car tu la redéfinis
    });

    // 📄 Affichage d'un article avec slug personnalisé
    // ⚠️ Ici, le nom est juste 'posts.show' (le préfixe blog. sera ajouté automatiquement)
    Route::get('/article/{slug}', [PostController::class, 'show'])->name('posts.show');

    // 🧠 Vue mixte : Articles Wikipédia + Articles créés
    Route::get('/article', function () {
        $posts = \App\Models\Post::latest()->get();
        return view('blog.articles.article', compact('posts'));
    })->name('article');
});
