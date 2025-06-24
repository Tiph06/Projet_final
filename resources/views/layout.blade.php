<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Info-Endo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <link rel="icon" type="image/png" href="{{ asset('images/ruban.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .leaflet-top {
            z-index: 501 !important;
            /* Evite que la carte passe par dessus la nav car !important force le css demandé */

        }
    </style>
    @vite([
    'resources/js/app.js',
    'resources/css/app.css',
    ])

</head>


<body class="bg-pink-50 text-gray-900 font-sans">
    <header>
        @include('layouts.navigation')
    </header>

    <div class="max-w-4xl mx-auto px-4">

        <main class="pt-20 max-w-4xl mx-auto p-4 mt-6">
            @yield('content')
        </main>

        <footer class="mt-10 py-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Info-Endo – Ensemble pour mieux comprendre 💛
        </footer>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('[data-animate-on-scroll]');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                        entry.target.classList.remove('opacity-0', 'translate-y-10', 'scale-75');
                        observer.unobserve(entry.target); // stop observer (like .once)
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