<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuiviController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = "test";
    return view('blog.index', compact('name'));
})->name('blog');

Route::get('/dashboard', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📅 Liste des suivis (page de visualisation principale)
    Route::get('/suivis', [SuiviController::class, 'index'])->name('suivis.index');


    // ➕ Formulaire de création
    Route::get('/suivis/create', [SuiviController::class, 'create'])->name('suivis.create');

    // 💾 Enregistrement d’un suivi
    Route::post('/suivis', [SuiviController::class, 'store'])->name('suivis.store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/temoignages.php';
require __DIR__ . '/acceuil.php';
require __DIR__ . '/article.php';
require __DIR__ . '/api.php';
