<x-guest-layout>
    <div class="w-full max-w-md">
        <x-auth-card>
            {{-- Logo centré --}}
            <x-slot name="logo">
                <a href="/" class="flex items-center justify-center">
                    <x-application-logo class="w-16 h-16 text-pink-500" />
                </a>
            </x-slot>

            {{-- Titre --}}
            <h1 class="text-center text-xl font-semibold text-gray-800 mb-6">
                Mot de passe oublié <span class="text-pink-600">Info-Endo</span>
            </h1>

            {{-- Statut (lien envoyé) --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <p class="text-sm text-gray-600 mb-4">
                Indique ton adresse e-mail et nous t’enverrons un lien pour réinitialiser ton mot de passe.
            </p>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email" name="email" type="emai