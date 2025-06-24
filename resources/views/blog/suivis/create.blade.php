t<form action="{{ route('suivis.store') }}" method="POST" class="space-y-4">
    @csrf

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