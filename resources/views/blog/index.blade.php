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
    <h1
        class="text-center text-3xl md:text-4xl font-bold uppercase tracking-wide text-pink-800 mb-4 opacity-0 translate-y-10 scale-75 transition-all duration-1000 ease-out"
        data-animate-on-scroll>
        Bienvenue sur Info-Endo 💛
    </h1>
    <p class="text-center text-gray-600 mb-12">Ce blog est dédié à mieux comprendre l’endométriose. Retrouvez ici nos derniers articles, nos ressources et des témoignages.</p>

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
    </section>

    <section class="text-left py-16 px-4 bg-pink-50 max-w-4xl mx-auto">
        <h2
            class="text-xl md:text-2xl text-pink-600 font-semibold mb-6 opacity-0 translate-y-10 transition-all duration-1000 delay-200 ease-out"
            data-animate-on-scroll>
            QU’EST-CE QUE L’ENDOMÉTRIOSE ?
        </h2>

        <div
            class="prose prose-p:text-gray-800 prose-p:leading-relaxed max-w-3xl mx-auto opacity-0 translate-y-10 transition-all duration-1000 delay-400 ease-out"
            data-animate-on-scroll style="text-align:left;">

            <p><em>Avant-propos :</em> Nous souhaitons bien sûr inclure les personnes transgenres. Aussi parlons-nous autant que possible de personnes atteintes ou de personnes menstruées atteintes. Si certaines pages du site n’ont pas été corrigées, veuillez nous en excuser.</p><br>

            <p>L’endométriose touche 1 personne menstruée sur 10. Maladie longtemps ignorée, parfois très difficile à vivre au quotidien, l’endométriose se définit comme la présence en dehors de la cavité utérine de tissu semblable à la muqueuse utérine qui subira, lors de chacun des cycles menstruels ultérieurs, l’influence des modifications hormonales.</p>

            <p>Cette maladie peut provoquer des douleurs pelviennes invalidantes, ainsi que d’autres symptômes selon la localisation des lésions. Elle peut aussi être une cause d’infertilité. Le retard moyen de diagnostic est d’environ 7 ans.</p><br>

            <h3>L’endométriose est une maladie complexe</h3>
            <p>Elle est devenue considérée comme une maladie systémique pouvant affecter plusieurs organes différents et altérer leur fonctionnement. Chaque personne atteinte présente un profil de maladie distinct.</p><br>

            <h3>Les formes d’endométriose</h3>
            <div class="flex flex-wrap gap-6 mt-4 mb-8">
                <div class="flex-1 min-w-[220px] rounded-xl p-5 bg-yellow-50 shadow-md" style="box-shadow: 0 2px 8px 0 rgba(245,201,81,0.075);">
                    <h4 class="font-bold text-yellow-800 mb-2">Superficielle (péritonéale)</h4>
                    <p class="text-yellow-700">Présence d’implants à la surface du péritoine.</p>
                </div>
                <div class="flex-1 min-w-[220px] rounded-xl p-5 bg-pink-200 shadow-md" style="box-shadow: 0 2px 8px 0 rgba(208,60,126,0.06);">
                    <h4 class="font-bold text-pink-700 mb-2">Ovarienne</h4>
                    <p class="text-pink-600">Formation de kystes endométriosiques avec un liquide de couleur chocolat.</p>
                </div>
                <div class="flex-1 min-w-[220px] rounded-xl p-5 bg-blue-50 shadow-md" style="box-shadow: 0 2px 8px 0 rgba(144,176,246,0.05);">
                    <h4 class="font-bold text-blue-700 mb-2">Pelvienne profonde</h4>
                    <p class="text-blue-600">Lésions infiltrant les tissus sous le péritoine (ligaments, intestin, vessie, etc.).</p>
                </div>
            </div>

            <p>Il existe également des formes extra-pelviennes touchant notamment le diaphragme ou le thorax. La sévérité de la douleur ne correspond pas toujours au type d’endométriose.</p><br>

            <h3>Origine et facteurs de risque</h3>
            <p>Plusieurs hypothèses coexistent : reflux menstruel, facteurs génétiques, perturbateurs endocriniens, dysfonctionnement immunitaire, etc. Le diagnostic précoce est essentiel pour limiter la progression de la maladie.</p><br>

            <p>Des facteurs comme une puberté précoce, des antécédents familiaux, et l’exposition à des polluants peuvent augmenter le risque.</p><br>

            <h3>La grossesse “guérit-elle” l’endométriose ?</h3>
            <p>La grossesse offre une rémission temporaire mais ne constitue pas une guérison définitive. Les symptômes peuvent revenir après l’accouchement.</p>

        </div>
    </section>

    <!-- Animation JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('[data-animate-on-scroll]');
            const onScroll = () => {
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight * 0.9 && el.classList.contains('opacity-0')) {
                        el.classList.remove('opacity-0', 'translate-y-10', 'scale-75');
                        el.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                    }
                });
            };
            window.addEventListener('scroll', onScroll);
            onScroll();
        });
    </script>

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