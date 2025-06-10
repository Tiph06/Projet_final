<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostTemoignageController;
use App\Models\PostTemoignage;

// 📢 Routes pour les témoignages
Route::prefix('temoignages')->name('temoignages.')->group(function () {

    // 🗂️ Page des témoignages paginés
    Route::get('/', function () {
        $posts = PostTemoignage::latest()->paginate(6);
        return view('temoignages', compact('posts'));
    })->name('index');

    // ➕ Création d’un témoignage (formulaire)
    Route::get('/create', function () {
        if (!auth()->check()) {
            session(['url.intended' => url()->current()]);
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour publier un témoignage.');
        }

        return app(PostTemoignageController::class)->create();
    })->name('create');

    // 💾 Enregistrement d’un témoignage (POST)
    Route::post('/', [PostTemoignageController::class, 'store'])
        ->middleware('auth')
        ->name('store');

    // ❌ Suppression d’un témoignage
    Route::delete('/{id}', [PostTemoignageController::class, 'destroy'])
        ->name('destroy');
});
