<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suivi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class SuiviController extends Controller
{
    public function index()
    {
        // Génère la liste des jours du mois courant
        $start = Carbon::now()->startOfMonth();
        $end   = Carbon::now()->endOfMonth();
        $days = [];
        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            $days[] = $date->copy();
        }

        // Récupère les suivis du mois, groupés par jour
        $suivisDuMois = Suivi::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('user_id', Auth::id())
            ->get()
            ->groupBy(fn($suivi) => Carbon::parse($suivi->date)->toDateString());


        // Récupère les suivis précédents pour la liste complète
        $suivis = Suivi::where('user_id', Auth::id())
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
        $validated = $request->validate([
            'date' => [
                'required',
                'date',
                'before_or_equal:today',
                Rule::unique('suivis', 'date')->where(fn($q) => $q->where('user_id', Auth::id()))
            ],
            'etat' => 'required|string|max:255',
            'douleurs' => 'required|boolean',
            'localisation' => 'nullable|array', // ← array car tu peux en cocher plusieurs
            'localisation.*' => 'nullable|string|max:255',
            'intensite'      => 'required_if:douleurs,1|nullable|integer|min:1|max:10',
        ]);

        //  Récupération et préparation des données
        $validated['douleurs']     = $request->boolean('douleurs');

        // Nettoyage: trim + suppression des vides
        $loc = collect($request->input('localisation', []))
            ->map(fn($v) => is_string($v) ? trim($v) : '')
            ->filter(fn($v) => $v !== '')
            ->values()
            ->all();

        $validated['localisation'] = $loc ? implode(', ', $loc) : null;

        // ✅ Création en réutilisant $validated
        Suivi::create([
            'user_id'      => Auth::id(),
            'date'         => $validated['date'],         // <- from validated
            'etat'         => $validated['etat'],
            'douleurs'     => $validated['douleurs'],
            'localisation' => $validated['localisation'],
            'intensite'    => $validated['intensite'] ?? null,
        ]);

        return to_route('suivi.index')->with('success', 'Suivi enregistré avec succès ! 🌸');
    }
}
