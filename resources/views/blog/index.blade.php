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
    <p class="text-center text-gray-600 mb-12">
        Ce blog est dédié à mieux comprendre l’endométriose. Retrouvez ici nos derniers articles, nos ressources et des témoignages.
    </p>


    <!-- Section Statistiques dynamiques -->
    <section class="mb-12">
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded shadow">
            <p class="font-semibold">Statistiques :</p>
            <p>30 à 40 % des femmes atteintes d’endométriose ont des difficultés à concevoir.</p>
        </div>

        <!-- A corriger! -->
        <!-- 🧁 Texte d'introduction -->
        <x-scroll-reveal
            title="Qu’est-ce que l’endométriose ?"
            subtitle="L’endométriose est une maladie complexe qui peut récidiver dans certains cas et générer des douleurs chroniques">

            L’endométriose, touche 1 femme sur 10 ou 1 personne menstruée sur 10. Maladie longtemps ignorée, parfois très difficile à vivre au quotidien, l’endométriose se définit comme la présence en dehors de la cavité utérine de tissu semblable à la muqueuse utérine* qui subira, lors de chacun des cycles menstruels ultérieurs, l’influence des modifications hormonales. Si la physiopathologie de l’endométriose n’est pas univoque et fait intervenir de nombreuses hypothèses (métaplasie, induction, métastatique, immunologique, génétique, épigénétique et environnementale, cellules souches…), il est impossible de comprendre cette maladie sans prendre en compte la théorie de la régurgitation dite « théorie de l’implantation ». Lors de la menstruation, sous l’effet des contractions utérines, une partie du sang est régurgité dans les trompes pour arriver dans la cavité abdomino-pelvienne. Cette théorie expliquerait la majorité des atteintes d’endométriose.
            >

            Ce sang contient des cellules endométriales, des fragments de muqueuse utérine, qui, au lieu d’être détruits par le système immunitaire, vont s’implanter puis, sous l’effet des stimulations hormonales ultérieures, proliférer sur les organes de voisinage (péritoine, ovaire, trompe, intestin, vessie, uretère, diaphragme…)
            >

            L’endométriose est ainsi responsable de douleurs pelviennes parfois particulièrement invalidantes mais aussi de beaucoup d’autres symptômes en fonction de la localisation des lésions. Dans certains cas, l’endométriose est aussi responsable d’infertilité. Les symptômes ont un impact considérable sur la qualité de vie des personnes atteintes avec un retentissement important sur leur vie personnelle et conjugale mais également professionnelle et sociale<br><br>

            Extrait de l’introduction du Professeur Charles Chapron dans Les idées reçues sur l’endométriose – Avril 2024 Editions le Cavalier bleu.<br>

            *Les différents médecins interrogés sur la question « endomètre ou pas? » répondent ceci : histologiquement, le résultat de l’analyse pathologique indique qu’il s’agit d’endomètre. Mais pour s’adapter à son « nouvel environnement », la cellule endométriale se modifie pour se greffer sur les organes. Il s’agit d’un endomètre modifié qui sera différent de l’endomètre tel qu’on le trouve dans l’utérus… d’où le fait que l’on parle de « cellules semblables à l’endomètre » mais c’est un tissu endométrial (glandes + stroma) qui se comporte de la même façon en réagissant aux variations hormonales. Voir le site de l’Inserm également sur l’endométriose.
        </x-scroll-reveal>

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
</div>

@if (session('success'))
<div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif

@endsection

@push('scripts')
<script>
    if (typeof Chart !== 'undefined') {
        // 🍩 Donut Charts
        new Chart(document.getElementById('donut1'), {
            type: 'doughnut',
            data: {
                labels: ['Concernées', 'Non concernées'],
                datasets: [{
                    data: [10, 90],
                    backgroundColor: ['#f472b6', '#e5e7eb']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                responsive: true
            }
        });

        new Chart(document.getElementById('donut2'), {
            type: 'doughnut',
            data: {
                labels: ['Retard diagnostique', 'Diagnostic précoce'],
                datasets: [{
                    data: [7, 3],
                    backgroundColor: ['#fb923c', '#e5e7eb']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                responsive: true
            }
        });

        new Chart(document.getElementById('donut3'), {
            type: 'doughnut',
            data: {
                labels: ['Femmes atteintes', 'Population mondiale'],
                datasets: [{
                    data: [190, 7810 - 190],
                    backgroundColor: ['#60a5fa', '#e5e7eb']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                responsive: true
            }
        });

        // 📊 Bar Charts
        new Chart(document.getElementById('bar1'), {
            type: 'bar',
            data: {
                labels: ['Nord', 'Sud', 'Est', 'Ouest'],
                datasets: [{
                    label: 'Cas (%)',
                    data: [30, 25, 20, 25],
                    backgroundColor: '#f472b6'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true
            }
        });

        new Chart(document.getElementById('bar2'), {
            type: 'bar',
            data: {
                labels: ['Péritonéale', 'Ovarienne', 'Profonde'],
                datasets: [{
                    label: 'Répartition',
                    data: [40, 35, 25],
                    backgroundColor: '#facc15'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true
            }
        });

        new Chart(document.getElementById('bar3'), {
            type: 'bar',
            data: {
                labels: ['15-25 ans', '26-35 ans', '36-45 ans'],
                datasets: [{
                    label: 'Répartition',
                    data: [20, 50, 30],
                    backgroundColor: '#5ba3c1'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true
            }
        });
    } else {
        console.warn('Chart.js non chargé 🤔');
    }
</script>

@endpush