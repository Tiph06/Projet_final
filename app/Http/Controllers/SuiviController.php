<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suivi;
use Illuminate\Support\Facades\Auth;

class SuiviController extends Controller
{
    // 📝 Affichage du formulaire de suivi
    public function create()
    {
        return view('suivis.create');
    }

    // 💾 Enregistrement du suivi
    public function store(Request $request)
    {
        $request->validate([
            'etat' => 'required|string|max:255',
            'douleurs' => 'required|boolean',
            'localisation' => 'nullable|string|max:255',
            'intensite' => 'nullable|integer|min:1|max:10',
        ]);

        Suivi::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'etat' => $request->etat,
            'douleurs' => $request->douleurs,
            'localisation' => $request->localisation,
            'intensite' => $request->intensite,
        ]);

        return redirect()->back()->with('success', 'Suivi enregistré avec succès 🩷');
    }

    // 📊 Affichage des suivis de l’utilisatrice connectée
    public function index()
    {
        $suivis = Suivi::where('user_id', Auth::id())->orderByDesc('date')->get();

        return view('blog.suivis.index', compact('suivis'));
    }
}
