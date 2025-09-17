@extends('layout')

@section('title', 'Accueil – Info-Endo')


@section('content')

@if(session('welcome'))
<div id="popup-welcome" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-pink-100 border border-pink-300 text-pink-800 px-4 py-2 rounded shadow-lg z-50 transition-opacity duration-500">
    {{ session('welcome') }}
</div>

<script>
    setTimeout(() => {
        const popup = document.getElementById('popup-welcome');
        if (popup) popup.style.opacity = '0';
    }, 4000);
</script>
@endif


<div class="container mx-auto px-4 py-8 z-10">

    <h1 class="text-3xl font-bold mb-6 text-center">Bienvenue sur Info-Endo 💛</h1>
    <p class="text-center text-gray-600 mb-12">Ce blog est dédié à mieux comprendre l’endométriose. Retrouvez ici nos derniers articles, nos ressources et des témoignages.
    </p>


    <!-- Section Statistiques dynamiques -->
    <section class="mb-12">
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded shadow">
            <p class="font-semibold">Statistiques :</p>
            <ul class="list-disc list-inside">
                @foreach($random_stats as $stat)
                <li>{{ $stat }}</li>
                @endforeach
            </ul>
        </div>


        <!-- 🍩 Donut Charts -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="font-bold text-gray-700 mb-2">1 femme sur 10</h3>
                <canvas id="donut1"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="font-bold text-gray-700 mb-2">7 ans de retard</h3>
                <canvas id="donut2"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="font-bold text-gray-700 mb-2">190 millions</h3>
                <canvas id="donut3"></canvas>
            </div>
        </section>


        <!-- 📊 Bar Charts -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="font-bold text-gray-700 mb-2">Répartition par régions</h3>
                <canvas id="bar1"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="font-bold text-gray-700 mb-2">Formes d’endométriose</h3>
                <canvas id="bar2"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="font-bold text-gray-700 mb-2">Tranches d’âge</h3>
                <canvas id="bar3"></canvas>
            </div>
        </section>
</div>

<!-- 🗺️ Carte Leaflet -->
<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Centres spécialisés en France</h2>
    <x-leaflet-map id="map-centres" :centres="$centres" height="h-96" />
</div>


@if (session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif
@endsection