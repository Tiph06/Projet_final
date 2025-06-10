<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
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

        return view('index', compact('posts', 'stat'));
    })->name('index');

    // // 🔍 Recherche
    // Route::get('/search', [SearchController::class, 'search'])->name('search');

    // 📝 CRUD des articles (sans show, qui a une URL custom)
    Route::resource('articles', PostController::class)->except(['show']);

    // 📄 Affichage d’un article
    Route::get('/article/{slug}', [PostController::class, 'show'])->name('posts.show');
});


// //     Route::get('/{slug}--{id}', function ($slug, $id) {
//         $post = Post::findOrFail($id);

//         $response = Http::get('https://api.unsplash.com/photos/random', [
//             'query' => 'endometriosis',
//             'client_id' => env('UNSPLASH_ACCESS_KEY'),
//             'orientation' => 'landscape',
//         ]);

//         $image = $response->successful() ? $response['urls']['regular'] : null;

//         return view('blog.articles.show', compact('post', 'image'));
//     })
//         ->where(['slug' => '[a-z0-9\-]+', 'id' => '[0-9]+'])
//         ->name('show');