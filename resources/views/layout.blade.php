<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Info-Endo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF pour axios/fetch --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/ruban.png') }}">

    {{-- Utilitaires CSS globaux --}}
    <style>
        /* Empêche les contrôles Leaflet de passer au-dessus de la nav */
        .leaflet-top {
            z-index: 501 !important;
        }

        /* Cache tout ce qui a x-cloak avant l'init Alpine */
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Vite (Tailwind + JS app) : Alpine, Chart.js et Leaflet sont importés dans resources/js/app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body class="bg-pink-50 text-gray-900 font-sans">
    <header>
        @include('layouts.navigation')
    </header>

    {{-- Wrapper principal --}}
    <div class="max-w-4xl mx-auto px-4">
        {{-- Espace sous la nav (si nav fixed/sticky) --}}
        <main class="pt-20 p-4 mt-6">
            @yield('content')
        </main>

        <footer class="mt-10 py-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Info-Endo – Ensemble pour mieux comprendre 💛<br>
            <a href="{{ route('cgu') }}" class="underline text-pink-600 hover:text-pink-700 transition">
                Conditions Générales d’Utilisation
            </a>
        </footer>
    </div>

    {{-- Scripts spécifiques aux pages --}}
    @yield('scripts')

    {{-- Petite animation d’apparition au scroll (facultatif) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('[data-animate-on-scroll]');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                        entry.target.classList.remove('opacity-0', 'translate-y-10', 'scale-75');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            elements.forEach(el => observer.observe(el));
        });
    </script>

    @stack('scripts')
</body>

</html>