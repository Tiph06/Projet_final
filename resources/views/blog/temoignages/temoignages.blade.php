@extends('layout')

@section('title', 'Témoignages – Info-Endo')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-pink-700">Témoignages 💬</h2>


<p class="mb-4 text-gray-700">Des personnes partagent ici leur vécu face à l’endométriose.</p>
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded mb-4 w-fit mx-auto">
    {{ session('success') }}
</div>
@endif

<!-- Filtres -->
<div class="mb-6 flex flex-wrap gap-2">
    <button onclick="filterCategory('all')" class="filter-btn bg-gray-200 text-gray-800 px-3 py-1 rounded">🗂️ Tous</button>
    <button onclick="filterCategory('Diagnostique')" class="filter-btn bg-pink-100 text-pink-700 px-3 py-1 rounded">🩺 Diagnostique</button>
    <button onclick="filterCategory('Symptômes')" class="filter-btn bg-pink-100 text-pink-700 px-3 py-1 rounded">🔥 Symptômes</button>
</div>

<div id="temoignages-list" class="space-y-6">
    @foreach ($temoignages as $categorie => $post)
    <div class="bg-white p-4 rounded shadow" data-category="{{ $post->categorie }}">
        <span class="text-sm font-semibold text-pink-600 uppercase block mb-1">
            {{ $post->categorie === 'Diagnostique' ? '🩺 Diagnostique' : '🔥 Symptômes' }}
        </span>
        <p class="text-sm text-gray-500 italic mb-1">Posté par : {{ $post->auteur }}</p>

        <p class="text-gray-800">
            {{ Str::limit($post->contenu, 150) }}
            <span class="text-pink-600 font-medium cursor-pointer hover:underline"
                onclick="openModal(`{{ e($post->contenu) }}`)">
                Lire la suite
            </span>
        </p>
        <form action="{{ route('temoignages.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Supprimer ce témoignage ?');" class="inline-block ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
        </form>
    </div>
    @endforeach
</div>


{{-- Bouton pour écrire son propre témoignage --}}
<div class="mt-8">*
    <a href="{{ route('temoignages.create') }}">
        <button class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 shadow">
            ✍️ Partager mon témoignage
        </button>
    </a>
</div>


</div>
<!-- Modale invisible -->
<div id="modal" class="fixed inset-0 bg-rose-300 bg-opacity-20 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-xl relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-600">
            &times;
        </button>
        <h2 class="text-xl font-bold text-rose-900 mb-4">Témoignage</h2>
        <p id="modalContent" class="text-slate-800"></p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal(content) {
        document.getElementById('modalContent').innerHTML = content.replace(/\n/g, '<br>');
        document.getElementById('modal').classList.remove('hidden');
    }

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modal').classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (e.target === document.getElementById('modal')) {
            document.getElementById('modal').classList.add('hidden');
        }
    });

    function filterCategory(category) {
        const items = document.querySelectorAll('#temoignages-list > div');
        items.forEach(item => {
            const itemCategory = item.dataset.category.toLowerCase();
            const selected = category.toLowerCase();
            const show = selected === 'all' || itemCategory === selected;
            item.style.display = show ? 'block' : 'none';
        });
    }
</script>
@endsection