<div x-data="{ open: false }" class="bg-white w-full md:w-64 shadow-md md:block">
    {{-- Header mobile --}}
    <div class="flex justify-between items-center md:hidden p-4 border-b">
        <h2 class="text-xl font-bold text-pink-600">Info-Endo</h2>
        <button @click="open = !open" class="text-pink-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav :class="{ 'block': open, 'hidden': !open }" class="px-6 py-4 space-y-3 md:block">
        <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-pink-600">📊 Tableau de bord</a>

        {{-- Pour tout utilisateur connecté --}}
        <a href="{{ route('temoignages.index') }}" class="block text-gray-700 hover:text-pink-600">💬 Témoignages</a>

        {{-- Pour les admins uniquement --}}
        @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('users.index') }}" class="block text-gray-700 hover:text-pink-600">👥 Utilisateurs</a>
        <a href="{{ route('posts.index') }}" class="block text-gray-700 hover:text-pink-600">📝 Articles</a>
        @endif

        <a href="#" class="block text-gray-400 cursor-not-allowed">📋 Suivi (à venir)</a>
    </nav>
</div>