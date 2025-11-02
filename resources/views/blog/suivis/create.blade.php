@extends('layout')

@section('content')

{{-- ✅ Message de succès --}}
@if (session('success'))
<div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
    {!! session('success') !!}
</div>
@endif

{{-- 🚨 Affichage des erreurs de validation --}}

@if($errors->any())
<div class="bg-red-50 text-red-700 px-3 py-2 rounded mb-3 text-sm">
    @foreach($errors->all() as $err) <div>• {{ $err }}</div> @endforeach
</div>
@endif
{{-- 📝 Formulaire de suivi --}}
<div class="flex items-center justify-center min-h-screen bg-pink-50">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-2xl mx-4">
        <form action="{{ route('suivi.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- 📅 Date -->
            <x-input-label for="date" value="Date du suivi" />
            <x-text-input id="date" name="date" type="date"
                :value="now()->toDateString()"
                required
                class="h-14 text-lg px-5 py-4" />
            <!-- 😌 État -->
            <x-input-label for="etat" value="Comment te sens-tu ?" />
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach([
                ['label' => 'Bien', 'emoji' => '😊'],
                ['label' => 'Fatiguée', 'emoji' => '😬'],
                ['label' => 'Irritée', 'emoji' => '😠'],
                ['label' => 'Triste', 'emoji' => '😢'],
                ['label' => 'Stressée', 'emoji' => '😰'],
                ['label' => 'Énergique', 'emoji' => '💪']
                ] as $i => $etat)
                <label for="etat-{{ $i }}" class="cursor-pointer">
                    <input type="radio" name="etat" id="etat-{{ $i }}" value="{{ $etat['label'] }}" class="hidden peer" required>
                    <div class="flex flex-col items-center justify-center px-3 py-2 text-sm bg-gray-100 rounded-lg peer-checked:bg-fuchsia-100 peer-checked:ring-2 peer-checked:ring-fuchsia-500 transition">
                        <span class="font-semibold">{{ $etat['label'] }}</span>
                        <span class="text-xl">{{ $etat['emoji'] }}</span>
                    </div>
                </label>
                @endforeach
            </div>

            <!-- 😣 Douleurs -->
            <div x-data="{ douleur: '0' }">
                <x-input-label value="Douleurs ?" />

                <div class="flex gap-4">
                    <!-- OUI -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="douleurs"
                            value="1"
                            x-model="douleur"
                            class="sr-only"
                            required>
                        <span
                            class="px-4 py-2 rounded-full border transition"
                            :class="douleur === '1'
                                ? 'bg-pink-200 ring-2 ring-fuchsia-500'
                                : 'bg-gray-100'">Oui</span>
                    </label>

                    <!-- NON -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="douleurs"
                            value="0"
                            x-model="douleur"
                            class="sr-only"
                            required>
                        <span
                            class="px-4 py-2 rounded-full border transition"
                            :class="douleur === '0'
                                ? 'bg-pink-200 ring-2 ring-fuchsia-500'
                                : 'bg-gray-100'">Non</span>
                    </label>
                </div>

                <!-- 🌸 Affichage conditionnel -->
                <div x-show="douleur === '1'" x-transition>
                    <!-- Tes champs localisation et intensité -->
                </div>
            </div>

            <!-- 🌍 Localisation (modifié, tout stylé !) -->
            <div x-data="{ localisations: [], autre: false, autreTexte: '' }">
                <x-input-label for="localisation_group" value="Localisation(s)" />
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2" id="localisation_group">
                    @foreach([
                    'Bas-ventre ou région pelvienne',
                    'Ovaires',
                    'Trompes de Fallope',
                    'Ligaments utéro-sacrés',
                    'Rectum et intestin',
                    'Vessie',
                    'Vagin',
                    'Cul-de-sac de Douglas'
                    ] as $zone)
                    <label class="cursor-pointer">
                        <!-- IMPORTANT: value statique + name="localisation[]" -->
                        <input type="checkbox"
                            name="localisation[]"
                            value="{{ $zone }}"
                            x-model="localisations"
                            class="hidden peer">
                        <div class="px-3 py-2 text-sm bg-gray-100 rounded-lg
                    peer-checked:bg-fuchsia-100 peer-checked:ring-2 peer-checked:ring-fuchsia-500 text-center">
                            {{ $zone }}
                        </div>
                    </label>
                    @endforeach


                    <!-- Case "Autre" -->
                    <label class="cursor-pointer">
                        <input type="checkbox" @change="autre = !autre" class="hidden peer">
                        <div class="px-3 py-2 text-sm bg-gray-100 rounded-lg
                  peer-checked:bg-fuchsia-100 peer-checked:ring-2 peer-checked:ring-fuchsia-500 text-center">
                            Autre
                        </div>
                    </label>
                </div>
                <!-- Champ texte si "Autre" est coché -->
                <div class="mt-3" x-show="autre" x-transition>
                    <input type="text"
                        x-model="autreTexte"
                        @change="$event.target.value = $event.target.value.trim()"
                        name="localisation[]"
                        placeholder="Précisez ici..."
                        class="w-full border rounded px-3 py-2" />
                </div>
            </div>

            <!-- 📈 Intensité -->
            <div x-data="{ intensite: 5 }">
                <x-input-label for="intensite" value="Intensité de la douleur (1 à 10)" />

                <!-- Le slider -->
                <input
                    id="intensite"
                    name="intensite"
                    type="range"
                    min="1"
                    max="10"
                    x-model="intensite"
                    class="w-full accent-fuchsia-500 transition-all duration-200" />

                <!-- Le texte dynamique -->
                <p class="text-sm text-center mt-1 text-fuchsia-600 font-semibold">
                    Intensité : <span x-text="intensite"></span>/10
                </p>
            </div>


            <!-- Bouton -->
            <div class="flex justify-end mt-6">
                <x-primary-button>Enregistrer</x-primary-button>
            </div>
        </form>
    </div>
</div>

@endsection