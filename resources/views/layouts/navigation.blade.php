<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled ? 'bg-pink-300 shadow-lg' : 'bg-pink-200 shadow-md'"
    class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out py-4">
    <div class="w-full max-w-7xl mx-auto px-4 flex items-center justify-between">
        {{-- Logo + titre --}}
        <div class="flex items-center space-x-2">
            <x-application-logo class="w-5 h-5" />
            <h1 class="text-2xl font-bold text-pink-900">Info-Endo</h1>
        </div>

        {{-- Liens Desktop --}}
        <nav class="hidden md:flex items-center gap-6">
            <a href="{{ url('/') }}" class="text-pink-900 hover:text-pink-700">Accueil</a>
            <a href="{{ route('blog.article') }}" class="text-pink-900 hover:text-pink-700">Article</a>
            <a href="{{ route('temoignages.index') }}" class="text-pink-900 hover:text-pink-700">Témoignages</a>

            @auth
            <a href="{{ route('suivi.index') }}" class="text-pink-900 hover:text-pink-700">Mes suivis</a>
            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-md bg-pink-600 text-white hover:bg-pink-700 transition">
                Mon compte
            </a>
            {{-- Déconnexion (POST, fidèle Breeze) --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-pink-800 hover:underline">
                    Se déconnecter
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="text-pink-900 hover:text-pink-700">Connexion</a>
            <a href="{{ route('register') }}" class="text-pink-900 hover:text-pink-700">Inscription</a>
            @endauth
        </nav>

        {{-- Hamburger Mobile --}}
        <button
            @click="open = !open"
            class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-pink-900 hover:bg-pink-300 focus:outline-none"
            :aria-expanded="open.toString()"
            aria-controls="mobile-menu"
            aria-label="Ouvrir le menu">
            <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Menu Mobile --}}
    <div id="mobile-menu" x-show="open" x-transition class="md:hidden border-t border-pink-300 bg-pink-100">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ url('/') }}" class="block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">Accueil</a>
            <a href="{{ route('blog.article') }}" class="block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">Article</a>
            <a href="{{ route('temoignages.index') }}" class="block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">Témoignages</a>

            @auth
            <a href="{{ route('suivi.index') }}" class="block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">Mes suivis</a>
            <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 bg-pink-600 text-white hover:bg-pink-700">
                Mon compte
            </a>
            {{-- Déconnexion (POST, fidèle Breeze) --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">
                    Se déconnecter
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">Connexion</a>
            <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 text-pink-900 hover:bg-pink-200">Inscription</a>
            @endauth
        </div>
    </div>
</header>