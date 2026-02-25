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
                Connexion à <span class="text-pink-600">Info-Endo</span>
            </h1>

            {{-- Statut de session (mot de passe reset, etc.) --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Mot de passe --}}
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Se souvenir + mot de passe oublié --}}
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="flex items-center gap-2 text-sm text-gray-700">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-fuchsia-600 focus:ring-fuchsia-500" name="remember">
                        <span>{{ __('Se souvenir de moi') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-pink-600 hover:text-fuchsia-600"
                        href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                    @endif
                </div>

                {{-- Bouton full width --}}
                <div class="pt-1">
                    <x-primary-button class="w-full">
                        {{ __('Se connecter') }}
                    </x-primary-button>
                </div>

                {{-- Lien vers inscription --}}
                <p class="text-center text-sm text-gray-600">
                    {{ __("Pas encore de compte ?") }}
                    <a href="{{ route('register') }}" class="font-medium text-pink-600 hover:text-fuchsia-600">
                        {{ __("Créer un compte") }}
                    </a>
                </p>
            </form>
        </x-auth-card>
    </div>
</x-guest-layout>