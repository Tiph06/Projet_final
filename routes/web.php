<?php

use Illuminate\Support\Facades\Route;

// 🏠 Page d’accueil
Route::get('/', fn() => redirect()->route('blog.index'));

// 📚 Page article Wikipédia
Route::get('/article', function () {
    $response = Http::get('https://fr.wikipedia.org/api/rest_v1/page/summary/Endométriose');
    $wiki = $response->successful() ? [
        'title' => $response['title'],
        'extract' => $response['extract'],
        'url' => $response['content_urls']['desktop']['page'],
    ] : null;
    return view('blog.article.article', compact('wiki'));
})->name('article');

// 🧾 Pages légales
Route::view('/cgu', 'legal.cgu')->name('cgu');
Route::view('/confidentialite', 'legal.confidentialite')->name('confidentialite');
Route::view('/mentions-legales', 'legal.mentions')->name('mentions');

// 🧩 Inclusion des autres groupes de routes
require __DIR__ . '/auth.php';
require __DIR__ . '/blog.php';
require __DIR__ . '/temoignages.php';
