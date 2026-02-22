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
            @auth
            <form action="{{ route('temoignages.like', $post) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="flex items-center gap-2 hover:scale-110 transition">
                    <img src="{{ asset('images/likes.png') }}" alt="Like" class="w-6 h-6">
                    <span class="text-sm text-gray-600">{{ $post->likesCount() }}</span>
                </button>
            </form>
            @else
            <div class="flex items-center gap-2 text-gray-400 mt-2">
                <img src="{{ asset('images/likes.png') }}" alt="Like" class="w-6 h-6 opacity-50">
                <span>{{ $post->likesCount() }}</span>
            </div>
            @endauth
        </div>
        @endforeach
    </div>
</x-app-layout>