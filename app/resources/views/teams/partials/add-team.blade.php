<div>
    <form method="post" action="/teams/add">
        @csrf
        
        <div>
            <x-input-label for="name" value="Team" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>Créer une équipe</x-primary-button>
        </div>
    </form>
</div>