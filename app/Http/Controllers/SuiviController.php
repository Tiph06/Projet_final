<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suivi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            'date' => 'required|date',
            'etat' => 'required|string|max:255',
            'douleurs' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'intensite' => 'nullable|integer|min:1|max:10',
        ]);

        Suivi::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'etat' => $request->etat,
            'douleurs' => (bool) $request->douleurs,
            'localisation' => $request->localisation,
            'intensite' => $request->intensite,
        ]);

        return redirect()->back()->with('success', 'Suivi enregistré avec succès ! 🌸 ');
    }

    // 📊 Affichage des suivis + calendrier
    public function index()
    {
        $userId = Auth::id();

        // Suivis classiques
        $suivis = Suivi::where('user_id', $userId)->orderByDesc('date')->get();

        // 🗓 Génération des jours du mois
        $year = now()->year;
        $month = now()->month;
        $start = Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();

        $days = [];
        while ($start->lte($end)) {
            $days[] = $start->copy();
            $start->addDay();
        }

        // Suivis du mois pour le calendrier
        $suivisDuMois = $suivis
            ->where('date', '>=', Carbon::create($year, $month, 1)->toDateString())
            ->where('date', '<=', Carbon::create($year, $month, 1)->endOfMonth()->toDateString())
            ->keyBy(fn($s) => $s->date);

        return view('blog.suivis.index', [
            'suivis' => $suivis,
            'days' => $days,
            'suivisDuMois' => $suivisDuMois,
        ]);
    }
}
