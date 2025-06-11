<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Info-Endo') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex flex-col md:flex-row">

        {{-- Sidebar : affichée uniquement sur les pages protégées --}}
        @if (request()->routeIs('dashboard') || request()->routeIs('users.*') || request()->routeIs('posts.*') || request()->routeIs('temoignages.*'))
        <x-sidebar />
        @endif

        {{-- Contenu principal --}}
        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
</body>

</html>