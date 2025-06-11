<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostTemoignageController;
use App\Models\PostTemoignage;
use Illuminate\Support\Facades\Auth;

// 📢 Routes pour les témoignages
Route::prefix('temoignages')->name('temoignages.')->group(function () {

    // 🗂️ Page des témoignages paginés
    Route::get('/', [PostTemoignageController::class, 'index'])
        // ->middleware(['auth'])
        ->name('temoignages'); // ✅ accessible à tous
    // Note: Si vous souhaitez restreindre l'accès, décommentez la ligne middleware ci-dessus.

    // ➕ Création d’un témoignage (formulaire)
    Route::get('/create', function () {
        if (!Auth::check()) { // Si l'utilisateur n'est pas connecté
            // Redirige vers la page de connexion avec un message d'erreur
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
