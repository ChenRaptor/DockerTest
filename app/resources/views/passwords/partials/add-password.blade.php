<div>
    <form method="post" action="{{ route('passwords.store') }}">
        @csrf
        
        <div>
            <x-input-label for="url" value="Uniform Resource Locator" />
            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" required />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>Ajouter le nouveau champ</x-primary-button>
        </div>
    </form>
</div>