<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled ? 'bg-pink-300 shadow-lg' : 'bg-pink-200 shadow-md'"
    class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out py-4">

    <div class="w-full max-w-7xl mx-auto px-4 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-application-logo class="w-5 h-5" />
            <h1 class="text-2xl font-bold text-pink-900">Info-Endo</h1>
        </div>

        <!-- Burger menu button (mobile) -->
        <button @click="open = !open" class="md:hidden text-pink-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Navigation links (desktop) -->
        <nav class="hidden md:flex items-center space-x-4">
            <a href="{{ route('blog') }}" class="text-pink-800 font-medium hover:underline">Accueil</a>
            <a href="{{ route('blog.article') }}" class="text-pink-800 font-medium hover:underline">Article</a>
            <a href="{{ route('temoignages.index') }}" class="text-pink-800 font-medium hover:underline">Témoignages</a>
            <a href="{{ route('suivi.index') }}" class="text-pink-800 font-medium hover:underline">Mes suivis</a>
            @auth
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-sm text-pink-700 font-medium hover:underline">Se déconnecter</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            @else
            <a href="{{ route('login') }}" class="text-sm text-pink-700 font-medium hover:underline">Connexion</a>
            <a href="{{ route('register') }}" class="text-sm text-pink-700 font-medium hover:underline">Inscription</a>
            @endauth
        </nav>
    </div>

    <!-- Navigation links (mobile dropdown) -->
    <div class="md:hidden px-4 pt-2" x-show="open" x-transition>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('blog') }}" class="text-pink-800 font-medium hover:underline">Accueil</a>
            <a href="{{ route('blog.article') }}" class="text-pink-800 font-medium hover:underline">Article</a>
            <a href="{{ route('temoignages.index') }}" class="text-pink-800 font-medium hover:underline">Témoignages</a>
            <a href="{{ route('suivi.index') }}" class="text-pink-800 font-medium hover:underline">Mes suivis</a>

            @auth
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                class="text-sm text-pink-700 font-medium hover:underline">Se déconnecter</a>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            @else
            <a href="{{ route('login') }}" class="text-sm text-pink-700 font-medium hover:underline">Connexion</a>
            <a href="{{ route('register') }}" class="text-sm text-pink-700 font-medium hover:underline">Inscription</a>
            @endauth
        </nav>
    </div>
</header>