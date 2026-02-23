<?php

use App\Http\Controllers\SuiviController;
use Illuminate\Support\Facades\Route;



// 📌 Routes protégées par authentification
Route::prefix('suivi')->name('suivi.')->middleware('auth')->group(function () {
    // 🏠 Tableau de bord des suivis
    Route::get('/', [SuiviController::class, 'index'])->name('index');

    // ➕ Formulaire d’ajout de suivi
    Route::get('/create', [SuiviController::class, 'create'])->name('create');

    // 💾 Enregistrement d’un suivi
    Route::post('/', [SuiviController::class, 'store'])->name('store')->middleware('auth');

    // // 📅 Calendrier mensuel des suivis
    // Route::get('/calendar', [SuiviController::class, 'calendar'])->name('calendar');
});
