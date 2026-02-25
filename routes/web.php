<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuiviController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('blog.index');
});

Route::get('/dashboard', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/cgu', 'cgu')->name('cgu');

require __DIR__ . '/acceuil.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/temoignages.php';
require __DIR__ . '/article.php';
require __DIR__ . '/api.php';
require __DIR__ . '/suivi.php';
