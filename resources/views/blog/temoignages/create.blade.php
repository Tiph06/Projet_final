@extends('layout')

@section('title', 'Partager mon témoignage – Info-Endo')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-pink-700">Partager mon témoignage ✍️</h2>

    <form action="{{ route('temoignages.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Catégorie -->
        <div>
            <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select name="categorie" id="categorie" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
                <option value="">-- Choisir une catégorie --</option>
                <option value="Diagnostique">Diagnostique</option>
                <option value="Symptômes">Symptômes</option>
            </select>
        </div>

        <!-- Contenu -->
        <div>
            <label for="contenu" class="block text-sm font-medium text-gray-700">Votre témoignage</label>
            <textarea name="contenu" id="contenu" rows="6" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"></textarea>
        </div>
        <!-- Consentement -->

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="anonyme" class="form-checkbox text-pink-600" checked>
                <span class="ml-2 text-gray-700">Je souhaite rester anonyme</span>
            </label>
        </div>
        <div class="mt-4" id="auteurField">
            <label for="auteur" class="block text-sm text-gray-700">Nom ou pseudo</label>
            <input type="text" name="auteur" id="auteur" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                placeholder="Ex : Marie93" />
        </div>

        <!-- Bouton -->
        <div class="text-right">
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 shadow">
                Envoyer 💌
            </button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.querySelector('input[name="anonyme"]');
        const auteurField = document.getElementById('auteurField');

        function toggleAuteur() {
            auteurField.style.display = checkbox.checked ? 'none' : 'block';
        }

        checkbox.addEventListener('change', toggleAuteur);
        toggleAuteur(); // au chargement
    });
</script>
@endsection