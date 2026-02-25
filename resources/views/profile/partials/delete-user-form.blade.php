<section class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-medium text-red-600 mb-2">🗑️ Supprimer le compte</h2>

        {{-- Message explicatif juste au-dessus du bouton --}}
        <p class="text-sm text-gray-600 mb-4">
            Une fois votre compte supprimé, toutes vos données seront effacées définitivement.
        </p>

        {{-- Bouton rouge danger --}}
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Supprimer mon compte
        </x-danger-button>
    </div>

    {{-- Modale de confirmation --}}
    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900 mb-2">
                Es-tu sûre de vouloir supprimer ton compte ?
            </h2>
            <p class="text-sm text-gray-600 mb-6">
                Cette action est irréversible. Merci de saisir ton mot de passe pour confirmer.
            </p>

            {{-- Mot de passe --}}
            <div class="mb-4">
                <x-input-label for="password" value="Mot de passe" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full"
                    placeholder="••••••••" />
                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuler
                </x-secondary-button>
                <x-danger-button>
                    Confirmer la suppression
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>