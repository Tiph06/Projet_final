@extends('layout')

@section('content')
<div class="py-10 px-6 bg-gray-100 min-h-screen">

    <!-- ✅ TOAST de bienvenue -->
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition.duration.600ms
        class="mb-4 px-4 py-3 rounded-lg bg-fuchsia-100 text-fuchsia-800 border border-fuchsia-300 shadow text-sm max-w-md mx-auto">
        🎉 Contente de te revoir, {{ ucfirst(auth()->user()->name) }} !
    </div>

    @if(auth()->user()->is_admin)
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📊 Tableau de bord Administrateur</h2>

    <!-- Admin cards / outils -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <x-dashboard.card icon="👥" title="Utilisateurs" :value="$userCount" />
        <x-dashboard.card icon="📝" title="Articles" :value="$postCount" />
        <x-dashboard.card icon="💬" title="Témoignages" :value="$temoignageCount" />
        <x-dashboard.card icon="📅" title="Activité Récente" :value="$lastActivity ?? 'Aucune'" />
    </div>

    @else
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        👋 Bienvenue {{ ucfirst(auth()->user()->name) }} sur ton tableau de bord
    </h2>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">🩺 Vos derniers suivis</h3>

        @if($suiviEtats->isEmpty())
        <p class="text-gray-500 italic">Aucun suivi pour le moment.</p>
        @else
        <ul class="space-y-2">
            @foreach($suiviEtats as $etat)
            <li class="text-sm text-gray-700">
                {{ $etat->created_at->format('d/m/Y') }} –
                <span class="font-medium text-pink-600">{{ ucfirst($etat->etat) }}</span>
                @if($etat->douleur)
                – Intensité : <span class="text-red-500">{{ $etat->intensite }}</span>
                @endif
            </li>
            @endforeach
        </ul>

        <div class="text-right mt-4">
            <a href="{{ route('suivi.index') }}" class="text-fuchsia-600 hover:underline text-sm font-medium">
                ➕ Voir tous mes suivis →
            </a>
        </div>
        @endif
    </div>

    <!-- ➕ Bouton flottant Ajouter un suivi -->
    <a href="{{ route('suivi.index') }}"
        title="Commencer un nouveau suivi"
        class="fixed bottom-6 right-6 bg-fuchsia-600 hover:bg-fuchsia-700 text-white font-bold py-3 px-5 rounded-full shadow-lg transition transform hover:scale-105 hover:animate-bounce z-50 flex items-center gap-2">
        <span class="text-xl">➕</span> Ajouter un suivi
    </a>
    @endif

</div>
@endsection