<?php

namespace App\Http\Controllers;

use App\Models\Suivi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
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

    // Affichage du formulaire de suivi
    public function create()
    {
        // ✅ VÉRIFICATION SANS relation User (directement sur Suivi)
        $today = now()->format('Y-m-d');
        $existingSuivi = Suivi::where('user_id', Auth::id())
            ->whereDate('date', $today)
            ->first();

        return view('blog.suivis.create', compact('existingSuivi'));
    }

    public function store(Request $request)
    {
        // ✅ VÉRIFICATION : Doublon pour cette date ?
        $existingSuivi = Suivi::where('user_id', Auth::id())
            ->where('date', $request->input('date'))
            ->first();

        if ($existingSuivi) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Vous avez déjà enregistré un suivi pour cette date.');
        }

        $validated = $request->validate([
            'date' => [
                'required',
                'date',
                'before_or_equal:today',
                Rule::unique('suivis', 'date')->where(fn($q) => $q->where('user_id', Auth::id()))
            ],
            'etat' => 'required|string|max:255',
            'douleurs' => 'required|boolean',
            'localisation' => 'nullable|array',
            'localisation.*' => 'nullable|string|max:255',
            'intensite' => 'required_if:douleurs,1|nullable|integer|min:1|max:10',
        ]);

        $validated['douleurs'] = $request->boolean('douleurs');
        $loc = collect($request->input('localisation', []))
            ->map(fn($v) => is_string($v) ? trim($v) : '')
            ->filter(fn($v) => $v !== '')
            ->values()
            ->all();
        $validated['localisation'] = $loc ? implode(', ', $loc) : null;

        Suivi::create([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'etat' => $validated['etat'],
            'douleurs' => $validated['douleurs'],
            'localisation' => $validated['localisation'],
            'intensite' => $validated['intensite'] ?? null,
        ]);

        return to_route('suivi.index')->with('success', 'Suivi enregistré ! 🌸');
    }
}
