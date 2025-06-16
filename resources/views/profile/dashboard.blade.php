@extends('layout')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📊 Tableau de bord</h2>
    </x-slot>

    <div class="py-8 px-6 bg-gray-100 min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-dashboard.card icon="👥" title="Utilisateurs" :value="$userCount" />
            <x-dashboard.card icon="📝" title="Articles" :value="$postCount" />
            <x-dashboard.card icon="💬" title="Témoignages" :value="$temoignageCount" />
        </div>

        <div class="mt-10">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">🔮 Suivi personnalisé</h3>
            <div class="p-4 bg-white rounded-xl border border-dashed border-pink-300 text-gray-500">
                En construction... bientôt ici, un espace de suivi pour les utilisateurs 💫
            </div>
        </div>
    </div>
</div>