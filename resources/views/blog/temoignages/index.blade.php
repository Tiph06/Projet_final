<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">💬 Liste des témoignages</h2>
    </x-slot>

    <div class="p-6">
        <p>Voici les témoignages disponibles !</p>

        @foreach ($posts as $post)
        <div class="p-4 my-4 bg-white rounded-xl shadow">
            <h3 class="font-bold text-pink-600">{{ $post->categorie }}</h3>
            <p class="text-gray-700 mt-2">{{ $post->content }}</p>
        </div>
        @endforeach
    </div>
</x-app-layout>