@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4 text-fuchsia-600">Mes suivis quotidiens </h2>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <h3 class="text-lg font-semibold text-gray-700 mb-2">Calendrier du mois</h3>

    <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-600 mb-8">
        @foreach(['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'] as $jour)
        <div class="font-bold">{{ $jour }}</div>
        @endforeach

        @foreach($days as $day)
        @php
        $suivi = $suivisDuMois[$day->toDateString()] ?? null;
        $isToday = $day->isToday();

        $etatEmoji = [
        'Fatiguée' => ['emoji' => '😴', 'bg' => 'bg-pink-200'],
        'Bien' => ['emoji' => '😊', 'bg' => 'bg-blue-100'],
        'Irritée' => ['emoji' => '😠', 'bg' => 'bg-red-100'],
        'Triste' => ['emoji' => '😢', 'bg' => 'bg-gray-200'],
        'Stressée' => ['emoji' => '😰', 'bg' => 'bg-yellow-100'],
        'Énergique' => ['emoji' => '💪', 'bg' => 'bg-green-200'],
        ];

        $bg = $suivi ? ($etatEmoji[$suivi->etat]['bg'] ?? 'bg-fuchsia-200') : 'bg-gray-100';
        $emoji = $suivi ? ($etatEmoji[$suivi->etat]['emoji'] ?? '') : '';
        @endphp


        <div
            @if($suivi)
            x-data
            @click="$dispatch('open-modal', {
                date: '{{ $day->translatedFormat('d F Y') }}',
                etat: '{{ $suivi->etat }}',
                douleurs: {{ $suivi->douleurs ? 'true' : 'false' }},
                localisation: '{{ $suivi->localisation }}',
                intensite: '{{ $suivi->intensite }}'
            })"
            @endif
            class="aspect-square p-2 border rounded {{ $bg }} {{ $isToday ? 'ring-2 ring-fuchsia-400' : '' }} {{ $suivi ? 'cursor-pointer hover:shadow-lg transition duration-150' : '' }}">
            <div class="text-sm font-bold">{{ $day->day }}</div>
            @if($suivi)
            <div class="text-sm mt-1">{{ $emoji }}</div>
            <div class="text-xs text-fuchsia-800 mt-1 truncate">
                {{ $suivi->etat }}
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- 🌸 Modale Alpine -->
    <div
        x-data="{ open: false, suivi: {} }"
        x-init="
            window.addEventListener('open-modal', e => {
                suivi = e.detail;
                open = true;
            });
        ">
        <template x-if="open">
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-4">
                    <h3 class="text-lg font-bold text-fuchsia-600 mb-4">📝 Détails du suivi</h3>

                    <div class="space-y-2 text-sm text-gray-700">
                        <p><strong>Date :</strong> <span x-text="suivi.date"></span></p>
                        <p><strong>État :</strong> <span x-text="suivi.etat"></span></p>

                        <template x-if="suivi.douleurs">
                            <div>
                                <p><strong>Douleurs :</strong> Oui</p>
                                <p><strong>Localisation :</strong> <span x-text="suivi.localisation"></span></p>
                                <p><strong>Intensité :</strong> <span x-text="suivi.intensite"></span>/10</p>
                            </div>
                        </template>

                        <template x-if="!suivi.douleurs">
                            <p><strong>Douleurs :</strong> Non</p>
                        </template>
                    </div>

                    <button @click="open = false" class="mt-6 bg-fuchsia-500 hover:bg-fuchsia-600 text-white py-2 px-4 rounded w-full">
                        Fermer
                    </button>
                </div>
            </div>
        </template>
    </div>

    @if($suivis->isEmpty())
    <p class="text-gray-500">Aucun suivi enregistré pour le moment.</p>
    @else
    <div class="grid gap-4">
        @foreach($suivis as $suivi)
        <div class="bg-white shadow rounded p-4 border border-gray-200">
            <p class="text-sm text-gray-400">
                {{ \Carbon\Carbon::parse($suivi->date)->translatedFormat('d F Y') }}
            </p>
            <p><strong>État :</strong> {{ $suivi->etat }}</p>

            <p class="flex items-center gap-1">
                <strong>Douleurs :</strong>
                <span class="inline-block w-2 h-2 rounded-full {{ $suivi->douleurs ? 'bg-red-500' : 'bg-green-400' }}"></span>
                {{ $suivi->douleurs ? 'Oui' : 'Non' }}
            </p>

            @if($suivi->douleurs)
            <p><strong>Localisation :</strong> {{ $suivi->localisation }}</p>
            <p><strong>Intensité :</strong> {{ $suivi->intensite }}/10</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- 🎯 Bouton flottant + pop-up de formulaire améliorée -->
<div
    x-data="{ openForm: false, douleur: '1', intensite: 5 }"
    @keydown.escape.window="openForm = false">

    <!-- 🩷 Bouton flottant -->
    <button
        @click="openForm = true"
        class="fixed bottom-6 right-6 bg-fuchsia-500 hover:bg-fuchsia-600 text-white text-3xl rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition transform hover:scale-110 hover:animate-bounce z-50"
        title="Ajouter un suivi">
        +
    </button>

    <!-- 🌸 Pop-up formulaire -->
    <div
        x-show="openForm"
        x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div
            x-show="openForm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl mx-4 relative"
            @click.outside="openForm = false">
            <h3 class="text-lg font-bold text-fuchsia-600 mb-4">📝 Ajouter un suivi</h3>

            <form method="POST" action="{{ route('suivi.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="date" value="{{ now()->toDateString() }}">

                <!-- 😌 État (émoticônes radios) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Comment te sens-tu ?</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach([
                        ['label' => 'Fatiguée', 'emoji' => '😬'],
                        ['label' => 'Bien', 'emoji' => '😊'],
                        ['label' => 'Irritée', 'emoji' => '😠'],
                        ['label' => 'Triste', 'emoji' => '😢'],
                        ['label' => 'Stressée', 'emoji' => '😰'],
                        ['label' => 'Énergique', 'emoji' => '💪']
                        ] as $etat)
                        <label class="cursor-pointer">
                            <input type="radio" name="etat" value="{{ $etat['label'] }}" class="hidden peer" required>
                            <div class="flex flex-col items-center justify-center px-3 py-2 text-sm bg-gray-100 rounded-lg peer-checked:bg-fuchsia-100 peer-checked:ring-2 peer-checked:ring-fuchsia-500 transition">
                                <span class="font-semibold">{{ $etat['label'] }}</span>
                                <span class="text-xl">{{ $etat['emoji'] }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                <!-- Douleurs -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Douleurs ?</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="douleurs" value="1" x-model="douleur" class="sr-only">
                            <span class="px-4 py-2 rounded-full border" :class="douleur === '1' ? 'bg-pink-200' : ''">Oui</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="douleurs" value="0" x-model="douleur" class="sr-only">
                            <span class="px-4 py-2 rounded-full border" :class="douleur === '0' ? 'bg-pink-200' : ''">Non</span>
                        </label>
                    </div>
                </div>

                <!-- Localisation et intensité (si douleurs == oui) -->
                <template x-if="douleur === '1'">
                    <div>
                        <div class="mb-3">
                            <label for="localisation" class="block text-sm font-medium text-gray-700">Localisation</label>
                            <input type="text" name="localisation" id="localisation" class="w-full border rounded px-3 py-2" />
                        </div>

                        <div class="mt-4" x-data="{ val: intensite }">
                            <label for="intensite" class="block text-sm font-medium text-gray-700 mb-1">Intensité</label>
                            <input type="range" name="intensite" min="1" max="10" x-model="val" class="w-full accent-fuchsia-500">
                            <p class="text-sm text-center mt-1 text-fuchsia-600 font-semibold">Intensité : <span x-text="val"></span>/10</p>
                        </div>
                    </div>
                </template>

                <!-- Boutons -->
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="openForm = false"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-fuchsia-500 text-white rounded hover:bg-fuchsia-600 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection