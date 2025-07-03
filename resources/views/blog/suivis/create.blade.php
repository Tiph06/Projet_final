{{-- ✅ Message de succès --}}
@if (session('success'))
<div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
    {!! session('success') !!}
</div>
@endif

{{-- 🚨 Affichage des erreurs de validation --}}
@if ($errors->any())
<div class="bg-red-100 text-red-800 p-4 rounded mb-4">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- 📝 Formulaire de suivi --}}
<form action="{{ route('suivi.store') }}" method="POST" class="space-y-4">
    @csrf

    <!-- 📅 Date -->
    <x-input-label for="date" value="Date du suivi" />
    <x-text-input id="date" name="date" type="date" :value="now()->toDateString()" required />

    <!-- 😌 État -->
    <x-input-label for="etat" value="Comment vous sentez-vous aujourd’hui ?" />
    <x-text-input id="etat" name="etat" type="text" required />

    <!-- 😣 Douleurs -->
    <x-input-label for="douleurs" value="Avez-vous des douleurs ?" />
    <select id="douleurs" name="douleurs" class="form-select">
        <option value="1">Oui</option>
        <option value="0">Non</option>
    </select>

    <!-- 🌍 Localisation -->
    <div x-data="{ autreChecked: false }">
        <x-input-label for="localisation_group" value="Localisation des douleurs (si oui)" />
        <div class="flex flex-col space-y-1" id="localisation_group">
            @php
            $zones = [
            'Bas-ventre ou région pelvienne',
            'Ovaires',
            'Trompes de Fallope',
            'Ligaments utéro-sacrés',
            'Rectum et intestin',
            'Vessie',
            'Vagin',
            'Cul-de-sac de Douglas',
            ];
            @endphp

            @foreach($zones as $zone)
            <label class="inline-flex items-center">
                <input type="checkbox" name="localisation[]" value="{{ $zone }}" class="mr-2">
                {{ $zone }}
            </label>
            @endforeach

            <!-- Case "Autre" -->
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" class="mr-2" @change="autreChecked = $event.target.checked">
                Autre
            </label>

            <!-- Champ texte si "Autre" est coché -->
            <div x-show="autreChecked" x-transition>
                <input type="text"
                    name="autre_localisation"
                    placeholder="Précisez ici..."
                    class="border rounded px-3 py-2 w-full mt-1" />
            </div>
        </div>
    </div>

    <!-- 📈 Intensité -->
    <x-input-label for="intensite" value="Intensité de la douleur (1 à 10)" />
    <x-text-input id="intensite" name="intensite" type="number" min="1" max="10" />

    <!-- Bouton -->
    <x-primary-button>Enregistrer</x-primary-button>
</form>