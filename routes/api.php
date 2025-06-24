<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Suivi;

Route::middleware('auth:sanctum')->get('/user/suivis', function (Request $request) {
    return Suivi::where('user_id', $request->user()->id)
        ->orderByDesc('date')
        ->take(7)
        ->get();
});
/**
 * Ce fichier me permet de définir les routes de mon API, 
 * c’est-à-dire les points d'accès que mon front (ou un outil comme Postman)
 * peut utiliser pour récupérer ou envoyer des données en format JSON.
 * 
 * Ici, je protège certaines routes avec Sanctum pour que seules les utilisatrices connectées
 * puissent accéder à leurs données personnelles, comme leurs suivis quotidiens.
 * 
 * Contrairement aux routes classiques dans `web.php`, 
 * ces routes ne renvoient pas de vues Blade, 
 * mais directement des réponses JSON pour les appels AJAX ou mobiles.
 */
