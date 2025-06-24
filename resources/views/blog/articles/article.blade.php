@extends('layout')

@section('title', 'Articles – Info-Endo')

@section('content')
<h2 class="text-2xl font-bold mb-4 text-pink-700">🧠 Articles liés à l’endométriose</h2>
<p class="text-lg mb-8 text-gray-700">
    Découvrez des articles enrichissants sur l'endométriose, l'adénomyose et d'autres sujets connexes.
    Ces ressources sont sélectionnées pour vous aider à mieux comprendre ces conditions et à trouver du soutien.
    <!-- Articles du blog -->
    @if(isset($posts) && $posts->count())
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    @foreach ($posts as $post)
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold text-pink-700 mb-2">{{ $post->title }}</h3>
        <p class="text-gray-700 mb-2">{{ \Illuminate\Support\Str::limit($post->content, 300) }}</p>
        <a href="{{ route('posts.show', ['slug' => $post->slug, 'id' => $post->id]) }}" class="text-pink-600 underline">
            Lire l’article →
        </a>
    </div>
    @endforeach
</div>

<p class="text-lg mb-8 text-pink-700">Voici quelques articles proposés par Wikipédia pour enrichir vos connaissances.</p>

{{ $posts->links() }}
@else
<p class="text-gray-500 mb-8">Aucun article du blog pour le moment.</p>
@endif

<!-- Spinner pour les articles Wikipédia -->
<div id="loading" class="flex justify-center items-center my-10">
    <svg class="animate-spin h-10 w-10 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
    </svg>
</div>

<!-- Conteneur des articles Wikipédia -->
<div id="wiki-container" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>
@endsection

@section('scripts')
<script>
    const topics = [
        "Endométriose",
        "Adénomyose",
        "Dysménorrhée",
        "Douleur_pelvienne",
        "Infertilité",
        "Gynécologie",
        "Santé_menstruelle"
    ];

    document.addEventListener('DOMContentLoaded', async () => {
        const container = document.getElementById('wiki-container');
        const loader = document.getElementById('loading');

        for (const topic of topics) {
            try {
                const response = await fetch(`https://fr.wikipedia.org/api/rest_v1/page/summary/${topic}`);
                const data = await response.json();

                const article = document.createElement('div');
                article.className = 'bg-white p-4 rounded shadow';

                article.innerHTML = `
                    <h3 class="text-lg font-semibold text-pink-600 mb-2">${data.title}</h3>
                    <p class="text-gray-700 mb-2">${data.extract}</p>
                    <a href="${data.content_urls.desktop.page}" target="_blank" class="text-pink-600 underline">
                        Lire plus sur Wikipédia →
                    </a>
                `;

                container.appendChild(article);
            } catch (error) {
                console.error("Erreur lors du chargement de l'article :", topic, error);
            }
        }

        loader.style.display = 'none';
    });
</script>
@endsection