@extends('layout')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📊 Tableau de bord Administrateur</h2>
    </x-slot>

    <div class="py-10 px-6 bg-gray-100 min-h-screen space-y-12">
        <!-- 1. Résumé Statistique -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-dashboard.card icon="👥" title="Utilisateurs" :value="$userCount" />
            <x-dashboard.card icon="📝" title="Articles" :value="$postCount" />
            <x-dashboard.card icon="💬" title="Témoignages" :value="$temoignageCount" />
            <x-dashboard.card icon="📅" title="Activité Récente" :value="$lastActivity ?? 'Aucune'" />
        </div>

        <!-- 2. Actions Rapides -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-fuchsia-700 mb-4">⚡ Actions rapides</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('blog.articles.create') }}" class="bg-fuchsia-600 hover:bg-fuchsia-700 text-white px-4 py-2 rounded-lg shadow">+ Nouvel Article</a>
                <a href="{{ route('temoignages.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow">+ Nouveau Témoignage</a>
                <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">Articles en attente</a>
                <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">Signalements</a>
            </div>
        </div>

        <!-- 3. Feedback ou messages -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">📬 Derniers retours utilisateurs</h3>
            <p class="text-gray-500 italic">Pas encore de messages. Créez un système de feedback pour améliorer le site !</p>
        </div>

        <!-- 4. Carte (placeholder) -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">🗺️ Répartition géographique</h3>
            <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center text-gray-600">
                Carte Leaflet en construction...
            </div>
        </div>

        <!-- 5. Bloc à Idées / TODO -->
        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-300">
            <h4 class="text-lg font-bold text-yellow-800">📝 Bloc à idées</h4>
            <ul class="list-disc list-inside text-yellow-700 mt-2">
                <li>Ajouter un champ "tags" aux articles</li>
                <li>Intégrer une API médicale (Wikipédia ou PubMed)</li>
                <li>Refondre la page d'accueil avec plus de visuels</li>
            </ul>
        </div>
    </div>
</div>