<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Modifier le mot de passe
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Assurez-vous que votre compte utilise un mot de passe long et sécurisé.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block font-medium text-sm text-gray-700">Mot de passe actuel</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block font-medium text-sm text-gray-700">Nouveau mot de passe</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-success-button class="w-full sm:w-auto">
                Sauvegarder
            </x-success-button>

            <p class="text-sm text-green-600" x-show="formSubmitted">Mot de passe mis à jour.</p>
        </div>
    </form>
</section>