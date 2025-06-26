<?php

use App\Http\Controllers\SuiviController;
use Illuminate\Support\Facades\Route;



// 📌 Routes protégées par authentification
Route::middleware(['auth'])->prefix('suivi')->name('suivi.')->group(function () {

    // 🏠 Tableau de bord des suivis
    Route::get('/', [SuiviController::class, 'index'])->name('index');

    // ➕ Formulaire d’ajout de suivi
    Route::get('/create', [SuiviController::class, 'create'])->name('create');

    // 💾 Enregistrement d’un suivi
    Route::post('/', [SuiviController::class, 'store'])->name('store');

    // // 📅 Calendrier mensuel des suivis
    // Route::get('/calendar', [SuiviController::class, 'calendar'])->name('calendar');
});
