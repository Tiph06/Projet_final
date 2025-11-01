<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suivi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SuiviController extends Controller
{
    public function index()
    {
        // Génère la liste des jours du mois courant
        $start = \Carbon\Carbon::now()->startOfMonth();
        $end = \Carbon\Carbon::now()->endOfMonth();
        $days = [];
        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            $days[] = $date->copy();
        }

        // Récupère les suivis du mois, groupés par jour
        $suivisDuMois = \App\Models\Suivi::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('user_id', \Auth::id())
            ->get()
            ->groupBy(function ($suivi) {
                return (new \Carbon\Carbon($suivi->date))->toDateString();
            });

        // Récupère les suivis précédents pour la liste complète
        $suivis = \App\Models\Suivi::where('user_id', \Auth::id())
            ->orderByDesc('date')
            ->get();

        return view('blog.suivis.index', compact('days', 'suivisDuMois', 'suivis'));
    }

    //  Affichage du formulaire de suivi
    public function create()
    {
        return view('blog.suivis.create');
    }

    //  Enregistrement du suivi
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'etat' => 'required|string|max:255',
            'douleurs' => 'nullable|string|max:255',
            'localisation' => 'nullable|array', // ← array car tu peux en cocher plusieurs
            'localisation.*' => 'string|max:255',
            'autre_localisation' => 'nullable|string|max:255',
            'intensite' => 'nullable|integer|min:1|max:10',
        ]);

        // Fusionner les localisations cochées + "autre"
        $localisations = $request->input('localisation'); // peut être null
        $autre = $request->input('autre_localisation');   // peut être null

        // Correction ici : on initialise toujours à tableau
        if (!is_array($localisations)) {
            $localisations = [];
        }

        if (!empty($autre)) {
            $localisations[] = $autre;
        }

        Suivi::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'etat' => $request->etat,
            'douleurs' => (bool) $request->douleurs,
            'localisation' => implode(', ', $localisations),
            'intensite' => $request->intensite,
        ]);

        return redirect()->back()->with('success', 'Suivi enregistré avec succès ! 🌸 ');
    }
}
