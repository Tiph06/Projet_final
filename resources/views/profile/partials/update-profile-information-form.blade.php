<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informations du profil
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Mettez à jour les informations de votre profil et votre adresse e-mail.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nom</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', auth()->user()->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Adresse e-mail</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', auth()->user()->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-success-button class="w-full sm:w-auto">
                Sauvegarder
            </x-success-button>

            <p class="text-sm text-green-600" x-show="formSubmitted">Modifications enregistrées.</p>
        </div>
    </form>
</section>