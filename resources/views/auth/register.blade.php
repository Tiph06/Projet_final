<x-guest-layout>
    <div class="w-full max-w-md">
        <x-auth-card>
            {{-- Logo centré --}}
            <x-slot name="logo">
                <a href="/" class="flex items-center justify-center">
                    <x-application-logo class="w-16 h-16 text-pink-500" />
                </a>
            </x-slot>

            {{-- Titre de page --}}
            <h1 class="text-center text-xl font-semibold text-gray-800 mb-6">
                Créer mon compte <span class="text-pink-600">Info-Endo</span>
            </h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Pseudo / Nom --}}
                <div>
                    <x-input-label for="name" :value="__('Pseudo')" />
                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        :value="old('email')"
                        required
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Mot de passe --}}
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Confirmation --}}
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                    <x-text-input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- CTA full width + lien login --}}
                <div class="pt-1 space-y-3">
                    <x-primary-button class="w-full">
                        {{ __('S\'inscrire') }}
                    </x-primary-button>

                    <p class="text-center text-sm text-gray-600">
                        {{ __('Déjà inscrit ?') }}
                        <a href="{{ route('login') }}" class="font-medium text-pink-600 hover:text-fuchsia-600">
                            {{ __('Se connecter') }}
                        </a>
                    </p>
                </div>
            </form>
        </x-auth-card>
    </div>
</x-guest-layout>