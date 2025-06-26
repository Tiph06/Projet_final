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

    <x-input-label for="date" value="Date du suivi" />
    <x-text-input id="date" name="date" type="date" :value="now()->toDateString()" required />

    <x-input-label for="etat" value="Comment vous sentez-vous aujourd’hui ?" />
    <x-text-input id="etat" name="etat" type="text" required />

    <x-input-label for="douleurs" value="Avez-vous des douleurs ?" />
    <select id="douleurs" name="douleurs" class="form-select">
        <option value="1">Oui</option>
        <option value="0">Non</option>
    </select>

    <x-input-label for="localisation" value="Localisation des douleurs (si oui)" />
    <x-text-input id="localisation" name="localisation" type="text" />

    <x-input-label for="intensite" value="Intensité de la douleur (1 à 10)" />
    <x-text-input id="intensite" name="intensite" type="number" min="1" max="10" />

    <x-primary-button>Enregistrer</x-primary-button>
</form>